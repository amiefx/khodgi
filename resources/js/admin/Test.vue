<template>
  <div id="app">
  <v-app id="inspire">
    <v-card
      max-width="500"
      class="mx-auto"
    >
      <v-toolbar
        color="teal"
        dark
      >
        <v-app-bar-nav-icon></v-app-bar-nav-icon>

        <v-toolbar-title>Topics</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
      </v-toolbar>

      <v-list>
        <v-list-group
          v-for="item in items"
          :key="item.name"
          v-model="item.is_active"
          :prepend-icon="item.icon"
          no-action
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="subItem in item.sub_category"
            :key="subItem.name"
            @click=""
          >
            <v-list-item-content>
              <v-list-item-title v-text="subItem.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-card>
  </v-app>
</div>
</template>

<script>
export default {
    data () {
    return {
        items:[],
      items111: [
        {
          action: 'local_activity',
          title: 'Attractions',
          sub_category: [
            { title: 'List Item' },
          ],
        },
        {
          action: 'restaurant',
          title: 'Dining',
          active: true,
          sub_category: [
            { title: 'Breakfast & brunch' },
            { title: 'New American' },
            { title: 'Sushi' },
          ],
        },
        {
          action: 'school',
          title: 'Education',
          sub_category: [
            { title: 'List Item' },
          ],
        },
        {
          action: 'directions_run',
          title: 'Family',
          sub_category: [
            { title: 'List Item' },
          ],
        },
        {
          action: 'healing',
          title: 'Health',
          sub_category: [
            { title: 'List Item' },
          ],
        },
        {
          action: 'content_cut',
          title: 'Office',
          sub_category: [
            { title: 'List Item' },
          ],
        },
        {
          action: 'local_offer',
          title: 'Promotions',
          sub_category: [
            { title: 'List Item' },
          ],
        },
      ],
    }
  },

  created() {
      axios.get('/api/categories')
                .then(res => this.items = res.data.categories)
                .catch(err => {

                })
  }
}
</script>

<style>

</style>
