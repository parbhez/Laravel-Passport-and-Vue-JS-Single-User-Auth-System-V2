<template>
   <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center" style="background-color: #1c222f;">
                <div class="flex-row text-center mx-auto">
                    <img src="../../../../public/assets/img/pages/login-light.png" alt="Auth Cover Bg color" width="300" data-app-light-img="pages/login-light.png" data-app-dark-img="pages/login-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="index" class="app-brand-link gap-2 mb-2">
                            <img src="../../../../public/assets/img/logo.png" class="main-logo" alt="">
                            <span class="subtitle">AIBotLite</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <form id="formAuthentication" class="mb-3" @submit.prevent="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email or Username</label>
                            <input type="email" class="form-control" v-model="credential.email" id="email" name="email-username" placeholder="Enter your email or username" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password"  v-model="credential.password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                    </form>


                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            credential: {
                email: "admin@gmail.com",
                password: "123456",
            },
        };
    },

    methods:{
        login(){
            this.$store.dispatch('login', this.credential)
            .then((response)=>{
                this.success(response.message);
                this.$router.push({
                    name: "AdminDashboard"
                });
            })
            .catch((error)=>{
               // return console.log(error);
                if(error.response.data.errors){
                    for(const[k,v] of Object.entries(error.response.data.errors)){
                    this.error(v);
                }}else{
                    this.error(error.response.data.message);
                }
            })
        }
    }
};
</script>
