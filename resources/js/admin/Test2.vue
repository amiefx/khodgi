<template>
  <v-app>
    <v-container>
      <!-- <v-simple-table>
        <template v-slot:default>
        <thead>
            <tr>
                <th>#</th>
                <th>#</th>
                <th>#</th>
                <th>#</th>
                <th>#</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <tr scope="row" v-for="(invoice_product, k) in invoice_products" :key="k">
            <td>
                <v-btn icon color="pink" @click="deleteRow(k, invoice_product)">
                    <v-icon>mdi-heart</v-icon>
                </v-btn>
            </td>
            <td>
                <v-text-field v-model="invoice_products.product_no"></v-text-field>
            </td>
            <td>
                <v-text-field v-model="invoice_products.product_name"></v-text-field>
            </td>
            <td>
                <v-text-field v-model="invoice_products.product_price" @change="calculateLineTotal(invoice_product)"></v-text-field>
            </td>
            <td>
                <v-text-field v-model="invoice_products.product_qty" @change="calculateLineTotal(invoice_product)"></v-text-field>
            </td>
            <td>
                <v-text-field v-model="invoice_products.line_total"></v-text-field>
            </td>
        </tr>
        </tbody>
        </template>
      </v-simple-table>-->

      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th>#</th>
              <th>#</th>
              <th>#</th>
              <th>#</th>
              <th>#</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(invoice_product, k) in invoice_products" :key="k">
              <td scope="row" class="trashIconContainer">
                <v-btn icon @click="deleteRow(k, invoice_product)">
                  <v-icon>mdi-heart</v-icon>
                </v-btn>
              </td>
              <td>
                <!-- <input class="form-control" type="text" v-model="invoice_product.product_no" /> -->
                <v-select
                  :items="items"
                  label="Outlined style"
                  v-model="invoice_product.product_no"
                ></v-select>
              </td>
              <td>
                <!-- <input class="form-control" type="text" v-model="invoice_product.product_name" /> -->
                <v-text-field v-model="invoice_product.product_name"></v-text-field>
              </td>
              <td>
                <!-- <input class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.product_price" @change="calculateLineTotal(invoice_product)" -->
                <!-- /> -->
                <v-text-field
                  type="number"
                  min="0"
                  step=".01"
                  v-model="invoice_product.product_price"
                  @change="calculateLineTotal(invoice_product)"
                ></v-text-field>
              </td>
              <td>
                <!-- <input class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.product_qty" @change="calculateLineTotal(invoice_product)"
                />-->
                <v-text-field
                  type="number"
                  min="0"
                  step=".01"
                  v-model="invoice_product.product_qty"
                  @change="calculateLineTotal(invoice_product)"
                ></v-text-field>
              </td>
              <td>
                <!-- <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.line_total" /> -->
                <v-text-field type="number" min="0" step=".01" v-model="invoice_product.line_total"></v-text-field>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
      <v-btn color="pink" @click="addNewRow">Add</v-btn>

      <v-divider></v-divider>

      <div>
        <v-card :loading="loading" class="mx-auto my-12" max-width="374">
          <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>

          <v-card-title>Cafe Badilico</v-card-title>

          <v-card-text>
            <v-row align="center" class="mx-0">
              <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>

              <div class="grey--text ml-4">4.5 (413)</div>
            </v-row>

            <div class="my-4 subtitle-1">$ • Italian, Cafe</div>

            <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
          </v-card-text>

          <v-divider class="mx-4"></v-divider>

          <v-card-title>Tonight's availability</v-card-title>

          <v-card-text>
            <v-chip-group
              v-model="selection"
              active-class="deep-purple accent-4 white--text"
              column
            >
              <v-chip>5:30PM</v-chip>

              <v-chip>7:30PM</v-chip>

              <v-chip>8:00PM</v-chip>

              <v-chip>9:00PM</v-chip>
            </v-chip-group>
          </v-card-text>

          <v-card-actions>
            <v-btn color="deep-purple lighten-2" text @click="reserve">Reserve</v-btn>
          </v-card-actions>
          <div class="sale-badge">15%</div>
        </v-card>
      </div>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    invoice_subtotal: 0,
    invoice_total: 0,
    invoice_tax: 5,
    invoice_products: [
      {
        product_no: "",
        product_name: "",
        product_price: "",
        product_qty: "",
        line_total: 0
      }
    ],
    items: ["Foo", "Bar", "Fizz", "Buzz"]
  }),

  methods: {
    saveInvoice() {
      console.log(JSON.stringify(this.invoice_products));
    },
    calculateTotal() {
      var subtotal, total;
      subtotal = this.invoice_products.reduce(function(sum, product) {
        var lineTotal = parseFloat(product.line_total);
        if (!isNaN(lineTotal)) {
          return sum + lineTotal;
        }
      }, 0);

      this.invoice_subtotal = subtotal.toFixed(2);

      total = subtotal * (this.invoice_tax / 100) + subtotal;
      total = parseFloat(total);
      if (!isNaN(total)) {
        this.invoice_total = total.toFixed(2);
      } else {
        this.invoice_total = "0.00";
      }
    },
    calculateLineTotal(invoice_product) {
      var total =
        parseFloat(invoice_product.product_price) *
        parseFloat(invoice_product.product_qty);
      if (!isNaN(total)) {
        invoice_product.line_total = total.toFixed(2);
      }
      this.calculateTotal();
    },
    deleteRow(index, invoice_product) {
      var idx = this.invoice_products.indexOf(invoice_product);
      console.log(idx, index);
      if (idx > -1) {
        this.invoice_products.splice(idx, 1);
      }
      this.calculateTotal();
    },
    addNewRow() {
      this.invoice_products.push({
        product_no: "",
        product_name: "",
        product_price: "",
        product_qty: "",
        line_total: 0
      });
    }
  }
};
</script>

<style>
@import url("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");

.sale-badge {
  background: #fc7070;
  color: #ffffff;
  font-size: 20px;
  font-weight: 700;
  line-height: 14px;
  padding: 7px 10px;
  text-transform: uppercase;
  z-index: 4;
  position: absolute;
  top: 0;
  left: 0;
}
</style>
