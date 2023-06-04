<template>
    <!--register model -->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form action="" method="post" novalidate>
                            <h2 class="text-center">Create New Account</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="firstName" v-model="firstName">
                                <div v-show="firstNameError" class="text-danger">
                                    ... first name is too short
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="lastName" v-model="lastName">
                                <div v-show="lastNameError" class="text-danger">
                                    ... last name is too short
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email" v-model="email">
                                <div v-show="emailError" class="text-danger">
                                    ... email is not valid
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="password" v-model="password">
                                <div v-show="passwordError" class="text-danger">
                                    ... password is too short
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"
                                        :disabled="!isValidForm"
                                        @click.prevent="submitRegister">
                                    Create Account
                                </button>
                            </div>
                            <div class="clearfix">
                                <a href="#" class="pull-right">Forgot Password?</a>
                            </div>
                        </form>
                        <p class="text-center">having account ?
                            <strong class="switch-tologin-modal"><a href="#">Login</a></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--register model -->

</template>

<script>
export default {
    data() {
        return {
            firstName: '',
            lastName: '',
            email: '',
            password: '',
        }
    },
    computed: {
        firstNameError() {
            return this.firstName.length > 0 && this.firstName.length < 4;
        },
        lastNameError() {
            return this.lastName.length > 0 && this.lastName.length < 4;
        },
        emailError() {
            return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.email.length > 0;
        },
        passwordError() {
            return this.password.length > 0 && this.password.length < 4;
        },
        isValidForm() {
            return this.firstName.length >= 4 &&
                this.lastName.length >= 4 &&
                (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) &&
                this.password.length >= 4;
        },
    },
    methods :{
        submitRegister(){
            console.log('submitted')
        },
    }
}

</script>
