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
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Reset Password form</v-toolbar-title>

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

                  <v-text-field
                    id="password"
                    label="New Password"
                    v-model="password"
                    :rules="passwordRules"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />

                  <v-text-field
                    id="password"
                    label="Confirm Password"
                    v-model="password_confirmation"
                    :rules="[passwordMatch]"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />

                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" block :disabled="!valid" @click.prevent="login">Login</v-btn>
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
      data(){
          return {
              text: '',
              email: '',
              token: '',
              password: '',
              passwordRules: [
                v => !!v || 'Password is required',
              ],
              password_confirmation: '',
              loading: false,
              snackbar: false,
              valid: true,
          }
      },
      computed: {
        passwordMatch(){
            return this.password != this.password_confirmation ? 'Password does Not Match' : true
        }
        },

     created () {
            this.email = this.$route.query.email
            this.token = this.$route.params.token
        },
     methods: {
          login: function(){
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

            axios.post('/api/password/reset',{'email': this.email, 'password': this.password, 'password_confirmation': this.password_confirmation, 'token': this.token})
                .then(res => {
                    this.$router.push('/login')
                })
                .catch( err => {
                    this.text = err.response.data.errors.password[0]
                    this.snackbar = true;
                })

          }
      },

  }
</script>
