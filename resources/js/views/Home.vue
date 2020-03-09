<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      temporary
      app
    >
      <v-list dense>
        <template v-for="item in items">
          <v-row
            v-if="item.heading"
            :key="item.heading"
            align="center"
          >
            <v-col cols="6">
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-col>
            <v-col
              cols="6"
              class="text-center"
            >
              <a
                href="#!"
                class="body-2 black--text"
              >EDIT</a>
            </v-col>
          </v-row>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item
            v-else
            :key="item.text"
            link
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar extended :clipped-left="$vuetify.breakpoint.mdAndUp" app class="hidden-sm-and-down">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" class="hidden-md-and-up" />

      <v-toolbar-title style="width: 300px" class="text-center mx-auto my-auto">
        <span class="text-center mx-auto my-auto">
          <v-img
            src="https://cdn.shopify.com/s/files/1/0011/0277/4316/files/Screen_Shot_2020-01-21_at_18.38_300x.png?v=1579671269"
            aspect-ratio="3.5"
            contain
          ></v-img>
        </span>
      </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        hide-details
        prepend-inner-icon="mdi-magnify"
        label="Search"
        class="hidden-sm-and-down"
      />

      <v-spacer />

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-avatar size="32px" item>
          <v-img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify" />
        </v-avatar>
      </v-btn>

      <template v-slot:extension>
        <v-tabs class="d-flex justify-center">
          <v-tab>Tab 1</v-tab>
          <v-tab>Tab 2</v-tab>
          <v-tab>Tab 3</v-tab>
        </v-tabs>
      </template>
    </v-app-bar>

    <v-app-bar :clipped-left="$vuetify.breakpoint.mdAndUp" app class="hidden-md-and-up">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" class="hidden-md-and-up" />

      <span class="text-center mx-auto my-auto">Khodgi</span>

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content>

        <v-carousel hide-delimiters>
                <v-carousel-item
                v-for="(item,i) in homeslides"
                :key="i"
                :src="item.large_image"
                :to="item.link"
                ></v-carousel-item>
            </v-carousel>

      <v-container fluid>

        <div class=" hidden-xs-only">
            <v-row no-gutters>
                <v-col cols="12" sm="4" md="4" lg="4" xl="4" class="my-3 mx-auto"
                    v-for="(item,i) in homesections"
                    :key="i"
                >
                    <v-hover v-slot:default="{ hover }">
                        <v-card
                        class="mx-3"
                        color="grey lighten-4"
                        :to="item.link"
                        >
                        <v-img
                            :aspect-ratio="0.75"
                            :src="item.image"
                        >

                        <v-expand-transition>
                          <div
                            v-if="hover"
                            class="d-flex transition-fast-in-fast-out white darken-2 v-card--reveal display-3 black--text"
                            style="height: 18%;"
                          >
                             <v-row>
                               <v-col cols="12">
                                 <h3 class="title text-uppercase orange--text text-center mt-5" >{{ item.name }}</h3>
                                 <h3 class="subtitle-1 font-weight-light orange--text text-center mb-8" style="text-decoration: underline;"> Shop Now </h3>
                               </v-col>
                             </v-row>

                          </div>
                        </v-expand-transition>

                        </v-img>

                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </div>

        <div class=" hidden-sm-and-up">
            <v-row no-gutters>
                <v-col cols="12" sm="4" md="4" lg="4" xl="4" class="my-3 mx-auto"
                    v-for="(item,i) in homesections"
                    :key="i"
                >
                    <v-hover v-slot:default="{  }">
                        <v-card
                        class="mx-auto"
                        color="grey lighten-4"
                        max-width="600"
                        :to="item.link"
                        >
                        <v-img
                            :aspect-ratio="0.75"
                            :src="item.image"
                        >

                        <v-expand-transition>
                          <div

                            class="d-flex transition-fast-in-fast-out white darken-2 v-card--reveal display-3 black--text"
                            style="height: 18%;"
                          >
                             <v-row>
                               <v-col cols="12">
                                 <h3 class="title text-uppercase orange--text text-center mt-5" >{{ item.name }}</h3>
                                 <h3 class="subtitle-1 font-weight-light orange--text text-center mb-8" style="text-decoration: underline;"> Shop Now </h3>
                               </v-col>
                             </v-row>

                          </div>
                        </v-expand-transition>

                        </v-img>

                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </div>

      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      dialog: false,
      drawer: false,
      homeslides: [],
      homesections: [],
      items: [
        { icon: 'mdi-contacts', text: 'Contacts' },
        { icon: 'mdi-history', text: 'Frequently contacted' },
        { icon: 'mdi-content-copy', text: 'Duplicates' },
        {
          icon: 'mdi-chevron-up',
          'icon-alt': 'mdi-chevron-down',
          text: 'Labels',
          model: true,
          children: [
            { icon: 'mdi-plus', text: 'Create label' },
          ],
        },
        {
          icon: 'mdi-chevron-up',
          'icon-alt': 'mdi-chevron-down',
          text: 'More',
          model: false,
          children: [
            { text: 'Import' },
            { text: 'Export' },
            { text: 'Print' },
            { text: 'Undo changes' },
            { text: 'Other contacts' },
          ],
        },
        { icon: 'mdi-settings', text: 'Settings' },
        { icon: 'mdi-message', text: 'Send feedback' },
        { icon: 'mdi-help-circle', text: 'Help' },
        { icon: 'mdi-cellphone-link', text: 'App downloads' },
        { icon: 'mdi-keyboard', text: 'Go to the old version' },
      ],


    }),

    created () {
      this.initialize()
      this.loadHomeSections()
    },

    methods: {
        initialize () {
            axios.get('/api/home-slides')
                .then(res => {
                    this.homeslides = res.data.homeslides
                })
                .catch(err => {
                    console.log();

                })
        },

        loadHomeSections () {
            axios.get('/api/home-sections')
                .then(res => {
                    this.homesections = res.data.homesections
                    console.log(res)
                })
                .catch(err => {
                    console.log();

                })
        }
    }
  }
</script>

<style scoped>
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        opacity: 1;
        position: absolute;
        width: 100%;
    }
</style>
