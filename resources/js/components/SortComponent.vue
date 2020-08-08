<template>
  <div id="sort" class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Sort</div>

          <div class="card-body">
            <div class="col-md-12">
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

                      <div class="col-md-12 row form-group">
                        <label for="integers">Integers</label>
                      </div>

                      <div class="col-md-12 row form-group">
                        <input
                          id="integers"
                          class="form-control"
                          name="integers"
                          v-model="integers"
                          placeholder="1,2,3,4,5"
                        >
                      </div>

                      <div class="col-md-12 row form-group">
                        <label for="integers">Sort</label>
                      </div>

                      <div class="col-md-12 row form-group">
                        <select v-model="sort" class="form-control">
                          <option disabled value="">Please Select</option>
                          <option v-bind:value="'1'">Ascending</option>
                          <option v-bind:value="'2'">Descending</option>
                        </select>
                      </div>

                      <div class="col-md-12 row form-group">
                        <input type="submit" value="Save" class="btn btn-primary">
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div
                class="col-md-12 mb-2"
                v-if="answer != ''"
              >
                <div class="row">
                  <div>The answer is: <span>{{ answer }}</span></div>
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
  export default {
    mounted() {
      console.log('success');
    },
    data() {
      return {
        integers: '',
        sort: '',
        answer: '',
        errors: []
      }
    },
    methods: {
      submitForm(e) {
        this.errors = [];
        this.answers = [];

        var integers = this.integers.split(',');

        if (integers.length < 5) {
          this.errors.push('Please enter at least 5 integers');
        } else {
          for (var i = 0; i < integers.length; i++) {
            integers[i] = parseInt(integers[i]);

            if (!Number.isInteger(integers[i])) {
              this.errors.push('Invalid entry of integers');
              break;
            }
          }
        }

        if (this.errors.length) {
          e.preventDefault();
          return;
        }

        if (this.errors.length < 1) {
          this.sortValue(integers, this.sort);
        }
      },
      sortValue(integers, sort) {
        for (var i = 0; i < integers.length - 1; i++) {
          for (var j = i + 1; j < integers.length; j++) {
            if (sort == 1) {
              if (integers[i] > integers[j]) {
                var temp = integers[i];
                integers[i] = integers[j];
                integers[j] = temp;
              }
            } else {
              if (integers[i] < integers[j]) {
                var temp = integers[i];
                integers[i] = integers[j];
                integers[j] = temp;
              }
            }
          }
        }

        this.answer = integers.join(', ');
      },
    },
    created() {
    },
  }
</script>
