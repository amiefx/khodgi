<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
    <div class="d-flex justify-center mb-3 headline">My Web APPlication</div>
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Register form</v-toolbar-title>

                <v-progress-linear
                :active="loading"
                :indeterminate="loading"
                absolute
                bottom
                color="deep-purple accent-4"
                ></v-progress-linear>

              </v-toolbar>

              <v-card-text>
                <v-form v-model="valid" method="post" v-on:submit.stop.prevent="login">

                    <v-text-field v-model="formItems.name" label="User Name" :rules="[rules.required, rules.min]"></v-text-field>
                    <v-text-field v-model="formItems.email" label="Email" :rules="[rules.required, rules.validEmail]"></v-text-field>
                    <v-text-field v-model="formItems.password" type="password" label="Password" :rules="[rules.required, rules.minpass]"></v-text-field>
                    <v-text-field v-model="formItems.password_confirmation" type="password" label="ReType Password" :rules="[rules.required, passwordMatch]"></v-text-field>

                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" block :disabled="!valid" @click.prevent="register">Register</v-btn>
              </v-card-actions>
            </v-card>


            <v-snackbar
            v-model="snackbar"
            >
            {{ text }}
            <v-btn
                color="white"
                text
                @click="snackbar = false"
            >
                Close
            </v-btn>
            </v-snackbar>

          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
      data: () => ({
      formItems: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
      },
      valid: true,
      loading: false,
      snackbar: false,
      text: '',
      roles: [],
      rules: {
          required: v => !!v || 'This Field is Required',
          min: v => v.length >=5 || 'Minimum 5 Chracters Required',
          minpass: v => v.length >=8 || 'Minimum 8 Chracters Required',
          validEmail: v => /.+@.+\..+/.test(v) || 'Email must be valid',
        },
      }),
      computed: {
            passwordMatch(){
                return this.formItems.password != this.formItems.password_confirmation ? 'Password does Not Match' : true
            }
        },
      methods: {
          register: function(){
              // Add a request interceptor
            axios.interceptors.request.use((config) => {
                this.loading = true
                return config;
            },  (error) => {
                this.loading = false
                return Promise.reject(error);
            });

            // Add a response interceptor
            axios.interceptors.response.use((response) => {
                this.loading = false
                return response;
            }, (error) => {
                this.loading = false
                return Promise.reject(error);
            });

            axios.post('/api/register', this.formItems)
            .then(res => {
                this.text = "Resistered Successfully!";
                this.snackbar = true;
                this.$router.push('/login')
            })
            .catch(err => {
                console.dir(err)
                this.text = "Error Registering to Website!";
                this.snackbar = true;
            })

          }
      },

  }
</script>
