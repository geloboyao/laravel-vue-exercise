<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Fibonacci</div>

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
                        <label for="input">Fibonacci Sequence</label>
                      </div>

                      <div class="col-md-12 row form-group">
                        <input
                          id="input"
                          class="form-control"
                          name="input"
                          v-model="input"
                          placeholder="4000000"
                        >
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
                v-if="output != ''"
              >
                <div class="row">
                  <div>The answer is: <span>{{ output }}</span></div>
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
        input: '',
        output: '',
        errors: []
      }
    },
    methods: {
      async update(input) {
        let response = await window.axios.post(`/api/fibonacci`, { input });

        if (response['data']['status'] == 'failed') {
          this.errors.push('No sequence detected');
          return;
        }

        this.output = response['data']['answer'];
      },
      async submitForm(e) {
        this.validate(e);

        if (this.errors.length < 1) {
          this.update(this.input);
        }
      },
      async validate() {
        this.errors = [];

        this.input = parseInt(this.input);

        if (!Number.isInteger(this.input)) {
          this.errors.push('Sequence must be integer');
          this.input = '';
          this.output = '';
        }

        if (this.errors.length) {
          e.preventDefault();
        }
      },
    },
    created() {
    },
  }
</script>
