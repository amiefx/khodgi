<template>
  <v-container>
    <v-card class="mx-auto">
      <v-list>
        <v-list-item>
          <v-list-item-icon>
            <v-list-item-avatar>
              <v-img :src="users.photo"></v-img>
            </v-list-item-avatar>
          </v-list-item-icon>
          <v-list-item-content></v-list-item-content>
          <v-list-item-action>
            <!-- <v-btn icon>
                  <v-icon>mdi-camera-account</v-icon>
            </v-btn>-->
            <!-- photo upload -->
            <v-dialog v-model="dialogPhoto" max-width="300px">
              <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                  <v-icon>mdi-camera-account</v-icon>
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">Update Profile Photo</span>
                </v-card-title>
                <v-card-text>
                  <v-col cols="12">
                    <v-file-input
                      v-model="editedItem.photo"
                      label="Select Photo"
                      placeholder="Upload Avatar"
                      accept="image/jpg, image/png, image/bmp, image/jpeg"
                      @change="uploadPhoto(item)"
                    />
                  </v-col>
                </v-card-text>
                <!-- <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialogPhoto = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="dialogPhoto = false">Save</v-btn>
                </v-card-actions>-->
              </v-card>
            </v-dialog>
            <!-- photo upload -->
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="title">{{ users.name }}</v-list-item-title>
            <v-list-item-subtitle>{{ users.email }}</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-btn icon>
              <v-icon @click="dialog = !dialog">mdi-pencil</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>

      <v-list>
        <v-list-item>
          <v-list-item-icon>
            <v-icon color="indigo">mdi-email</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ users.email }}</v-list-item-title>
            <v-list-item-subtitle>Email</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-divider inset></v-divider>

        <v-list-item>
          <v-list-item-icon>
            <v-icon color="indigo">mdi-account-box</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ users.name }}</v-list-item-title>
            <v-list-item-subtitle>User Name</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>

    <v-dialog v-model="dialog" width="500px">
      <v-card>
        <v-card-title class>Update Profile</v-card-title>
        <v-form v-model="valid" method="post" v-on:submit.stop.prevent="save">
          <v-card-text>
            <v-container>
              <v-col cols="12">
                <v-text-field
                  prepend-icon="mdi-mail"
                  placeholder="User Name"
                  v-model="users.name"
                  :rules="[rules.required, rules.min]"
                />

                <v-text-field
                  type="password"
                  prepend-icon="mdi-lock"
                  placeholder="Password"
                  v-model="users.password"
                  :rules="[rules.required]"
                />

                <v-text-field
                  type="password"
                  prepend-icon="mdi-lock"
                  placeholder="Confirm Password"
                  v-model="users.rpassword"
                  :rules="[rules.required, passwordMatch]"
                />
              </v-col>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer />

            <v-btn color="blue darken-1" text @click="dialog = false">Cancel</v-btn>
            <v-btn color="blue darken-1" type="submit" :disabled="!valid" @click.prevent="save">Save</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    dialog: false,
    dialogPhoto: false,
    selectedFile: null,
    users: {
      id: "",
      name: "",
      email: "",
      role: "",
      photo: "",
      password: "",
      rpassword: "",
      created_at: ""
    },
    item: [],
    editedIndex: -1,
    editedItem: {
      id: "",
      name: "",
      email: "",
      role: "",
      photo: "",
      created_at: ""
    },
    rules: {
      required: v => !!v || "This Field is Required",
      min: v => v.length >= 5 || "Minimum 5 Chracters Required",
      validEmail: v => /.+@.+\..+/.test(v) || "Email must be valid"
    }
  }),
  methods: {
    uploadPhoto(item) {
      if (this.editedItem.photo != null) {
        const index = this.users.id;
        let formData = new FormData();
        formData.append(
          "photo",
          this.editedItem.photo,
          this.editedItem.photo.name
        );
        formData.append("user", this.users.id);
        axios
          .post("/api/change-photo", formData)
          .then(res => {
            this.users = res.data.user;
            // this.editedItem.photo = null
          })
          .catch(err => console.log(err.response));
      }
    },
    initialize() {
      axios
        .get("/api/my-account")
        .then(res => {
          this.users = res.data.users;
          this.dialogPhoto = false;
        })
        .catch(err => console.dir(err.response));
    },

    save() {
      axios
        .put("/api/user/update-profile/" + this.users.id, this.users)
        .then(res => {
          this.users = res.data.user;
          this.text = "Record Updated Successfully!";
          this.snackbar = true;
          this.dialog = false;
        })
        .catch(err => {
          console.log(err.response);
          this.text = "Error Updating Record";
          this.snackbar = true;
        });
    }
  },

  created() {
    this.initialize();
  },

  computed: {
    passwordMatch() {
      return this.users.password != this.users.rpassword
        ? "Password does Not Match"
        : true;
    }
  }
};
</script>

<style>
</style>
