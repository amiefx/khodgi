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
                <v-toolbar-title>Login form</v-toolbar-title>

                <v-progress-linear
                :active="loading"
                :indeterminate="loading"
                absolute
                bottom
                color="white"
                ></v-progress-linear>

              </v-toolbar>

              <v-card-text>
                <v-form v-model="valid" method="post" v-on:submit.stop.prevent="login">
                  <v-text-field
                    label="Login"
                    v-model="email"
                    :rules="emailRules"
                    name="login"
                    prepend-icon="mdi-account-circle"
                    type="text"
                    required
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    v-model="password"
                    :rules="passwordRules"
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
              <v-card-actions class="d-flex justify-end mr-2">
                      <router-link class="overline" :to="'/forgotpassword'" > Forgot Password </router-link>
              </v-card-actions>
            </v-card>

           <div class="d-flex justify-center mt-3">
               <div class="caption mr-3 mt-1">Don't have Account?</div>
               <div>
                   <router-link class="overline" :to="'/register'" > SignUp </router-link>
                </div>
           </div>

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
              emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
              password: '',
              passwordRules: [
                v => !!v || 'Password is required',
              ],
              loading: false,
              snackbar: false,
              valid: true,
          }
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

            axios.post('/api/login',{'email': this.email, 'password': this.password})
                .then(res => {
                    localStorage.setItem('token', res.data.access_token)
                    localStorage.setItem('loggedIn', true)
                    if(res.data.isAdmin) {
                        this.$router.push('/admin')
                        .then(res => console.log('LoggedIn Successfully'))
                        .catch(err => console.log(err))
                    }else{
                        // this.text = "You Need to be LoggedIn as an Administrator";
                        // this.snackbar = true
                        this.$router.push('/account')
                    }
                })
                .catch( err => {
                    this.text = err.response.data.status
                    this.snackbar = true;
                })

          }
      },

  }
</script>
