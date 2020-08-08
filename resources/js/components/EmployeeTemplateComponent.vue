<template>
  <div id="employee" class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <span>Employees</span>
          </div>

          <div class="card-body">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <form id="submit-form" class="submit-form" @submit.prevent="submitForm">
                      <div class="col-md-12">
                        <div class="row">
                          <p v-if="this.errors.length">
                            <b>Please correct the following error(s):</b>
                            <ul>
                              <li v-for="error in errors">{{ error }}</li>
                            </ul>
                          </p>

                          <div class="col-md-12 row">
                            <label for="first-name">First Name</label>
                            <input
                              id="first-name"
                              class="form-control"
                              name="firstname"
                              v-model="firstname"
                              placeholder="First Name"
                            >
                          </div>

                          <div class="col-md-12 row">
                            <label for="last-name">Last Name</label>
                            <input
                              id="last-name"
                              class="form-control"
                              name="lastname"
                              v-model="lastname"
                              placeholder="Last Name"
                            >
                          </div>

                          <div class="col-md-12 row">
                            <label for="last-name">Position</label>
                            <input
                              id="position"
                              class="form-control"
                              name="position"
                              v-model="position"
                              placeholder="Position"
                            >
                          </div>

                          <div class="col-md-12 row">
                            <label for="birthdate">Birthdate</label>
                            <date-picker
                              v-model="birth_date"
                              format="YYYY-MM-DD"
                              :editable="false"
                              :default-value="birth_date"
                              :type="'date'"
                              :clearable="false"
                              :input-class="'form-control'"
                            ></date-picker>
                            <div class="form-group">
                            </div>
                          </div>

                          <div class="col-md-12 row action-buttons">
                            <input type="submit" :value="button" class="btn btn-primary">
                            <input
                              v-show="employee_function == 'update'"
                              @click="clearForm"
                              type="button"
                              value="Clear"
                              class="btn btn-primary clear-btn"
                            >
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Birthdate</th>
                            <th></th>
                          </tr>
                        </thead>

                        <tbody>
                          <employee-component
                            v-for="employee in employees"
                            v-bind="employee"
                            @edit="edit"
                            @del="del"
                            :key="employee.id"
                          ></employee-component>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import DatePicker from 'vue2-datepicker';
  import VueMoment from 'vue-moment';
  import moment from 'moment-timezone';
  import VueToast from 'vue-toast-notification';

  import EmployeeComponent from './EmployeeComponent.vue';

  import 'vue2-datepicker/index.css';
  import 'vue-toast-notification/dist/theme-default.css';

  Vue.use(VueToast);
  Vue.use(VueMoment, {
    moment
  });

  function Employee({id, firstname, lastname, position, birth_date}) {
    this.id = id;
    this.firstname = firstname;
    this.lastname = lastname;
    this.position = position;
    this.birth_date = birth_date;
  }

  export default {
    mounted() {
      console.log('success');
    },
    data() {
      return {
        employees: [],
        employee_id: null,
        firstname: '',
        lastname: '',
        position: '',
        birth_date: '',
        button: 'Create',
        employee_function: 'create',
        errors: []
      }
    },
    methods: {
      async read() {
        const { data } = await window.axios.get('/api/employee/show');

        this.employees = [];

        data.forEach(employee => this.employees.push(new Employee(employee)));
      },
      async create(firstname, lastname, position, birth_date) {
        await window.axios.post(`/api/employee`, { firstname, lastname, position, birth_date });

        let toast = Vue.$toast.open({
          message: 'Employee successfully created.',
          type: 'success',
          position: 'top-right'
        });

        this.read();
      },
      async update(id, firstname, lastname, position, birth_date) {
        await window.axios.put(`/api/employee/${id}`, { firstname, lastname, position, birth_date });

        let toast = Vue.$toast.open({
          message: 'Employee successfully updated.',
          type: 'success',
          position: 'top-right'
        });

        this.read();
      },
      async del(id) {
        await window.axios.delete(`/api/employee`, { data: { id: id } });

        let toast = Vue.$toast.open({
          message: 'Employee successfully deleted.',
          type: 'success',
          position: 'top-right'
        });

        this.clearForm();
        this.read();
      },
      edit(id, firstname, lastname, position, birth_date) {
        this.employee_id = id;
        this.firstname = firstname;
        this.lastname = lastname;
        this.position = position;
        this.birth_date = new Date(birth_date);
        this.employee_function = 'update';
        this.button = 'Update';
      },
      async submitForm() {
        this.errors = [];

        if (!this.firstname) {
          this.errors.push('First Name required');
        }

        if (!this.lastname) {
          this.errors.push('Last Name required');
        }

        if (!this.position) {
          this.errors.push('Position required');
        }

        if (!this.birth_date) {
          this.errors.push('Birthdate required');
        }

        if (this.errors.length) {
          e.preventDefault();
          return;
        }

        var birth_date = moment(this.birth_date).format('YYYY-MM-DD');

        if (this.employee_function == 'create') {
          this.create(this.firstname, this.lastname, this.position, birth_date);
        } else {
          this.update(this.employee_id, this.firstname, this.lastname, this.position, birth_date);
        }
      },
      clearForm() {
        this.employee_id = '';
        this.firstname = '';
        this.lastname = '';
        this.position = '';
        this.birth_date = '';
        this.employee_function = 'create';
        this.button = 'Create';
      }
    },
    created() {
      this.read();
    },
    components: {
      EmployeeComponent
    }
  }
</script>
