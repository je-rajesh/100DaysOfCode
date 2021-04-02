<template>
  <div>
    <login>
      <!-- login page for user.  -->
      <div class="row justify-center q-mt-md items-center">
        <div class="col-xs-11 col-sm-10 col-md-4 col-lg-3 col-xl-3">
          <p class="text-h4 text-center q-pt-sm">Login</p>
          <q-card-section>
            <!-- <div class="text-h6">Email</div> -->

            <q-form
              class="q-gutter-md"
              @submit.prevent="onSubmit"
              @reset="onReset"
            >
              <q-input
                type="text"
                label="Enter Your Email/Usename"
                lazy-rules
                outlined
                v-model="email"
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type your email',
                ]"
              />

              <q-input
                type="password"
                label="Enter Your Password"
                v-model="password"
                outlined
                lazy-rules
                :rules="[
                  (val) =>
                    (val && val.length > 0) || 'Please type your password',
                ]"
              />

              <q-checkbox v-model="remember_me" label="Remember Me" />

              <div>
                <q-btn label="Submit" type="submit" color="primary" />
                <q-btn
                  label="Reset"
                  type="reset"
                  color="primary"
                  flat
                  class="q-ml-sm"
                />
              </div>
            </q-form>
          </q-card-section>
        </div>
      </div>
    </login>

    <!-- registration here -->
    <registration>
      <div class="row justify-center q-mt-md items-center">
        <div class="col-xs-11 col-sm-10 col-md-4 col-lg-3 col-xl-3">
          <p class="text-h4 text-center q-pt-sm">Registration</p>
          <q-card-section>
            <!-- <div class="text-h6">Email</div> -->

            <q-form
              class="q-gutter-md"
              @submit.prevent="onSubmit"
              @reset="onReset"
            >
              <q-input
                type="text"
                label="Enter Your Full Name"
                lazy-rules
                outlined
                v-model="name"
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type your name',
                ]"
              />
              <q-input
                type="text"
                label="Enter Your Email"
                lazy-rules
                outlined
                v-model="email"
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type your email',
                ]"
              />
              <q-input
                type="text"
                label="Enter Your Username"
                lazy-rules
                outlined
                v-model="username"
                :rules="[
                  (val) =>
                    (val && val.length > 0) || 'Please type your username',
                ]"
              />

              <q-input
                type="password"
                label="Enter Your Password"
                v-model="password"
                lazy-rules
                outlined
                :rules="[
                  (val) =>
                    (val && val.length > 0) || 'Please type your password',
                ]"
              />
              <div>
                <q-btn label="Submit" type="submit" color="primary" />
                <q-btn
                  label="Reset"
                  type="reset"
                  color="primary"
                  flat
                  class="q-ml-sm"
                />
              </div>
            </q-form>
          </q-card-section>
        </div>
      </div>
    </registration>
  </div>
</template>
