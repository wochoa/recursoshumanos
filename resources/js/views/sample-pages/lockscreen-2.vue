<script>
import logoDark from '../../../images/logo-dark.png';
import logoLight from '../../../images/logo-light.png';
import avatar1 from '../../../images/users/avatar-1.jpg';

export default {
  data() {
    return {
      slide: 0,
      sliding: null,
      logoDark, logoLight, avatar1,
    };
  },
  components: {},
  methods: {
    onSlideStart(slide) {
      this.sliding = true
    },
    onSlideEnd(slide) {
      this.sliding = false
    }
  },
  mounted() {
    document.body.classList.add("auth-body-bg");
  },
};
</script>

<template>
  <div>
    <div class="container-fluid p-0">
      <div class="row g-0">
        <div class="col-xl-9">
          <div class="auth-full-bg pt-lg-5 p-4">
            <div class="w-100">
              <div class="bg-overlay"></div>
              <div class="d-flex h-100 flex-column">
                <div class="p-4 mt-auto">
                  <div class="row justify-content-center">
                    <div class="col-lg-7">
                      <div class="text-center">
                        <h4 class="mb-3">
                          <i
                            class="bx bxs-quote-alt-left text-primary h1 align-middle mr-3"
                          ></i
                          ><span class="text-primary">5k</span>+ Satisfied
                          clients
                        </h4>

                        <div dir="ltr">
                          <b-carousel id="carousel-1" v-model="slide" :interval="4000" indicators
                            @sliding-start="onSlideStart" @sliding-end="onSlideEnd">
                            <b-carousel-slide>
                              <p class="font-size-16 mb-4">
                                " Fantastic theme with a ton of options. If you
                                just want the HTML to integrate with your
                                project, then this is the package.
                                documentation talks about. "
                              </p>
                              <div>
                                <h4 class="font-size-16 text-primary">
                                  Abs1981
                                </h4>
                                <p class="font-size-14 mb-0">- Skote User</p>
                              </div>
                            </b-carousel-slide>
                            <b-carousel-slide>
                              <p class="font-size-16 mb-4">
                                " If Every Vendor on Envato are as supportive as
                                Themesbrand, Development with be a nice
                                experience. You guys are Wonderful. Keep us the
                                good work. "
                              </p>
                              <div>
                                <h4 class="font-size-16 text-primary">
                                  nezerious
                                </h4>
                                <p class="font-size-14 mb-0">- Skote User</p>
                              </div>
                            </b-carousel-slide>
                          </b-carousel>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->

        <div class="col-xl-3">
          <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">
              <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5">
                  <router-link to="/" class="d-block auth-logo">
                    <img
                      :src="logoDark"
                      alt=""
                      height="18"
                      class="auth-logo-dark"
                    />
                    <img
                      :src="logoLight"
                      alt=""
                      height="18"
                      class="auth-logo-light"
                    />
                  </router-link>
                </div>
                <div class="my-auto">
                  <div>
                    <h5 class="text-primary">Lock screen</h5>
                    <p class="text-muted">
                      Enter your password to unlock the screen!
                    </p>
                  </div>

                  <div class="mt-4">
                    <form class="form-horizontal">
                      <div class="user-thumb text-center mb-4">
                        <img
                          :src="avatar1"
                          class="rounded-circle img-thumbnail avatar-md"
                          alt="thumbnail"
                        />
                        <h5 class="font-size-15 mt-3">Maria Laird</h5>
                      </div>

                      <div class="mb-3">
                        <label for="userpassword">Password</label>
                        <input
                          type="password"
                          class="form-control"
                          id="userpassword"
                          placeholder="Enter password"
                        />
                      </div>

                      <div class="form-group row mb-0">
                        <div class="col-12 text-end">
                          <button
                            class="btn btn-primary w-md waves-effect waves-light"
                            type="submit"
                          >
                            Unlock
                          </button>
                        </div>
                      </div>
                    </form>
                    <div class="mt-5 text-center">
                      <p>
                        Not you ? return
                        <router-link
                          to="/auth/login-2"
                          class="fw-medium text-primary"
                        >
                          Sign In
                        </router-link>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="mt-4 mt-md-5 text-center">
                  <p class="mb-0">
                    © {{ new Date().getFullYear() }} Skote. Crafted with
                    <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container-fluid -->
  </div>
</template>

<style lang="scss" scoped>
:deep(.carousel-caption) {
  position: relative !important;
  right: 0;
  bottom: 1.25rem;
  left: 0;
  padding-top: 1.25rem;
  padding-bottom: 1.25rem;
  color: #495057;
  text-align: center;
}

:deep(.carousel-indicators li) {
  background-color: rgba(85, 110, 230, 0.25);
}

.carousel-item {
  background: none !important;
}
</style>