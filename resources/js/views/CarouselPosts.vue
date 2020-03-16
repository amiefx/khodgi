<template>
  <div>
      <!-- <carousel
    :perPage="1"
    :scrollPerPage="true"
    :mouse-drag="true"
    :touchDrag="true"
    :navigationEnabled="false"
    :autoplay="true"
    :paginationEnabled="true"
    :perPageCustom="[[360, 1], [768, 3], [1024, 4]]"
  >
    <slide class="mx-auto"
        v-for="(item,i) in products"
        :key="i"
    >
      <v-hover v-slot:default="{ hover }">
        <v-card class="mx-auto" color="grey lighten-4" max-width="300">
          <v-img :aspect-ratio="0.66" :src="item.image1">
            <v-expand-transition>
              <div
                v-if="hover"
                class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                style="height: 100%;"
              >$20.99</div>
            </v-expand-transition>
          </v-img>
          <v-card-text class="pt-6" style="position: relative;">
            <v-btn absolute color="orange" class="white--text" fab large right top>
              <v-icon>mdi-cart</v-icon>
            </v-btn>
            <div class="font-weight-light grey--text title mb-0 text-center">{{ item.name }}</div>
            <h3 class="title font-weight-black orange--text mb-0 text-center">Rs.{{ item.price_pkr}}</h3>
            <div class="font-weight-light title mb-0 text-center">Our Vintage kitchen.</div>
          </v-card-text>
        </v-card>
      </v-hover>
    </slide>

  </carousel> -->
  </div>

</template>

<script>
export default {
  data: () => ({
      products: [],
  }),

  created() {

        axios.get('/api/products/get-home-products')
            .then(res => {
                this.products = res.data.products
                console.log(res)
            })
            .catch(err => {
                console.log();

            })
        },
    computed: {
        newPrice: function() {
            return 22;
        }
    }

};
</script>

<style scoped>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>
