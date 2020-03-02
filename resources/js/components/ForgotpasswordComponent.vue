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
                <v-toolbar-title>Forgot Password form</v-toolbar-title>

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
                    label="Enter your email"
                    v-model="email"
                    :rules="emailRules"
                    name="login"
                    prepend-icon="mdi-email"
                    type="text"
                    required
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" block :disabled="!valid" @click.prevent="sendmail">Send Request</v-btn>
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
              emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
              loading: false,
              snackbar: false,
              valid: true,
          }
      },
      methods: {
          sendmail: function(){
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

            axios.post('/api/password/email',{'email': this.email})
                .then(res => {
                   this.text = 'We have e-mailed your password reset link!'
                   this.snackbar = true
                })
                .catch( err => {
                   this.text = console.log(err.response)
                   this.text = err.response.data.error
                   this.snackbar = true
                })

          }
      },

  }
</script>
