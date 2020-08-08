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
      async submitForm(e) {
        this.errors = [];
        this.output = '';

        var tempInput = this.input;

        this.input = Number(this.input);

        if (this.input.toString() != tempInput) {
          this.errors.push('Your number is too big');
          return;
        }

        if (!Number.isInteger(this.input)) {
          this.errors.push('Sequence must be integer');
          return;
        }

        if (this.errors.length) {
          e.preventDefault();
          return;
        }

        if (this.errors.length < 1) {
          this.findSequence();
        }
      },
      findSequence() {
        if (this.input == 1) {
          this.output = 1;
        }

        var num1 = 1;
        var num2 = 1;

        for (var i = 3; ; i++) {
            var temp = num1 + num2;
            num1 = num2;
            num2 = temp;

          if (temp == this.input) {
            this.output = i;
            break;
          } else if (temp > this.input) {
            this.errors.push('No sequence detected');
            break;
          }
        }
      }
    },
    created() {
    },
  }
</script>
