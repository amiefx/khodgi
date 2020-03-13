<template>
  <v-app>
    <v-container>
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">General</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute>
                  <!-- <span v-if="open" key="0">Select trip destination</span>
                  <span v-else key="1">{{ trip.location }}</span>-->
                </v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row no-gutters  class="d-flex justify-space-around">
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <v-text-field label="Name"></v-text-field>
                <v-select :items="locations" label="Category"></v-select>
                <v-checkbox label="isActive"></v-checkbox>
              </v-col>
              <v-divider vertical class="mx-4 hidden-xs-only"></v-divider>
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <vue-simplemde v-model="locations" ref="markdownEditor" />
              </v-col>
            </v-row>

            <!-- <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn text color="secondary">Cancel</v-btn>
              <v-btn text color="primary">Save</v-btn>
            </v-card-actions>-->
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">Price</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute></v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row no-gutters class="d-flex justify-space-around">
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <v-text-field label="Price PKR"></v-text-field>
                <v-text-field label="Price USD"></v-text-field>
                <v-text-field label="Price AUD"></v-text-field>
                <v-text-field label="Price EUR"></v-text-field>
                <v-text-field label="Price GBP"></v-text-field>
              </v-col>
              <v-divider vertical class="mx-4 hidden-xs-only"></v-divider>
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <v-text-field label="Special Price % OFF"></v-text-field>

                <v-menu
                  v-model="menu2"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="date"
                      label="Special Price Start"
                      prepend-icon="mdi-calendar-month"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                </v-menu>

                <v-menu
                  v-model="menu3"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="date2"
                      label="Special Price End"
                      prepend-icon="mdi-calendar-month"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date2" @input="menu3 = false"></v-date-picker>
                </v-menu>

              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">Inventory</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute>
                </v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row no-gutters  class="d-flex justify-space-around">
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <v-text-field label="SKU"></v-text-field>
                <v-checkbox label="Stock Availability"></v-checkbox>
              </v-col>
              <v-divider vertical class="mx-4 hidden-xs-only"></v-divider>
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                <v-checkbox label="Manage Inventory"></v-checkbox>
                <v-text-field label="Quantity"></v-text-field>
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">Images</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute>
                </v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row no-gutters  class="d-flex justify-space-around">
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                Images
              </v-col>
              <v-divider vertical class="mx-4 hidden-xs-only"></v-divider>
              <v-col cols="12" sm="5" md="5" lg="5" xl="5">
                Images2
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>



        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">Location</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute>
                  <span v-if="open" key="0">Select trip destination</span>
                  <span v-else key="1">{{ trip.location }}</span>
                </v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row no-gutters>
              <v-spacer></v-spacer>
              <v-col cols="5">
                <v-select v-model="trip.location" :items="locations" chips flat solo></v-select>
              </v-col>

              <v-divider vertical class="mx-4"></v-divider>

              <v-col cols="3">
                Select your destination of choice
                <br />
                <a href="javascript:void(0)">Learn more</a>
              </v-col>
            </v-row>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn text color="secondary">Cancel</v-btn>
              <v-btn text color="primary">Save</v-btn>
            </v-card-actions>
          </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel>
          <v-expansion-panel-header v-slot="{ open }">
            <v-row no-gutters>
              <v-col cols="4">Start and end dates</v-col>
              <v-col cols="8" class="text--secondary">
                <v-fade-transition leave-absolute>
                  <span v-if="open">When do you want to travel?</span>
                  <v-row v-else no-gutters style="width: 100%">
                    <v-col cols="6">Start date: {{ trip.start || 'Not set' }}</v-col>
                    <v-col cols="6">End date: {{ trip.end || 'Not set' }}</v-col>
                  </v-row>
                </v-fade-transition>
              </v-col>
            </v-row>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row justify="space-around" no-gutters>
              <v-col cols="3">
                <v-menu
                  ref="startMenu"
                  :close-on-content-click="false"
                  :return-value.sync="trip.start"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="trip.start"
                      label="Start date"
                      prepend-icon="event"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="$refs.startMenu.isActive = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.startMenu.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>

              <v-col cols="3">
                <v-menu
                  ref="endMenu"
                  :close-on-content-click="false"
                  :return-value.sync="trip.end"
                  offset-y
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="trip.end"
                      label="End date"
                      prepend-icon="event"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="$refs.endMenu.isActive = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.endMenu.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    date: null,
    menu2: null,
    menu3:null,
    trip: {
      name: "",
      location: null,
      start: null,
      end: null
    },
    locations: [
      "Australia",
      "Barbados",
      "Chile",
      "Denmark",
      "Equador",
      "France"
    ]
  })
};
</script>
