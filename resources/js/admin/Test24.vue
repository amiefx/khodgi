<template>
  <v-app>
    <v-container>
      <v-select
        v-model="attrib"
        :items="attribs"
        item-text="name"
        item-value="id"
        label="Arrtibute Set ID"
        @change="locadSubAttributes"
      ></v-select>

      <v-select
        v-model="subattrib"
        :items="subattribs"
        item-text="name"
        item-value="id"
        label="Sub"
      ></v-select>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => {
    return {
      attrib: "",
      attribs: [],
      subattrib: "",
      subattribs: []
    };
  },
  mounted() {
    this.loadAttribs();
  },
  methods: {
    loadAttribs() {
      axios
        .get("/api/attribute-sets")
        .then(res => {
          this.attribs = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    locadSubAttributes() {
      axios
        .get(`/api/subattribs/${this.attrib}`)
        .then(res => {
          this.subattribs = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>

<style>
</style>
