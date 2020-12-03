// constants
const SLIMAPI = "api"

// main app
new Vue({
  el: '#app',
  vuetify: new Vuetify(),

  data: {
    items: [],
    form: {
      description: '',
      quantity: 1
    },
    control: {
      showForm: false
    }
  },

  mounted() {
    // load data from the db
    this.load();
  },

  methods: {

    reset: function() {
      let me = this;

      me.form.description = '';
      me.form.quantity = 1;
    },

    edit: function(item) {
      let me = this;

      me.form = item;
      me.control.showForm = true;
    },

    remove: function(item) {
      let me = this;

      axios.delete(SLIMAPI+"/item/"+item.itemid).then(response => {
        me.load();
      });
    },

    submit: function() {
      let me = this,
          data = me.form;

      axios.post(SLIMAPI+"/item", data).then(function (response) {
        if (response.data.itemid > 0) {
          me.load();
          me.control.showForm = false;
        } else {
          console.log('Error: Could not submit record');
        }
      });
    },

    load: function() {
      let me = this;

      axios.get(SLIMAPI+"/item").then(response => {
        me.items = response.data.records;
      });
    },

    createNew: function() {
      let me = this;

      me.reset();
      me.control.showForm = true;
    }
  }

});
