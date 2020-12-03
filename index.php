<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app">
    <v-app>
      <v-main>
        <v-container>Shopping List</v-container>

        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Description</th>
                <th class="text-left">Quantity</th>
                <th class="text-right"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in items" :key="item.itemid">
                <td>{{ item.description }}</td>
                <td>{{ item.quantity }}</td>

                <td>
                  <v-btn small color="deep-orange" @click="edit(item)">Edit</v-btn>
                  <v-btn small color="red" @click="remove(item)">Remove</v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>

        <v-btn color="success" class="mr-4" @click="createNew()"> + New </v-btn>

        <v-container v-if="control.showForm">
          <v-form ref="form">
            <v-text-field label="Regular" placeholder="Description" v-model="form.description"></v-text-field>
            <v-slider v-model="form.quantity" label="Quantity"></v-slider>
            <v-btn color="error" class="mr-4" @click="reset">
              Reset
            </v-btn>
            <v-btn color="success" class="mr-4" @click="submit">
              Submit
            </v-btn>
          </v-form>
        </v-container>
      </v-main>
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="app.js"></script>
</body>
</html>
