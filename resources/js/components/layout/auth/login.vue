<template>
    <v-app>
    <v-container fill-height style="height: 100vh;" >
        <v-row wrap justify="center" align="center">
            <v-card min-width="500px" >
                <v-container>
                    <v-form @submit.prevent="login">
                            <v-card-text>
                                <v-text-field
                                    v-model="formData.email"
                                    label="Email"
                                />
                                <v-text-field
                                    v-model="formData.password"
                                    label="Senha"
                                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="show1 ? 'text' : 'password'"
                                    name="input-10-1"
                                    hint="Mínimo de 7 caracteres"
                                    counter
                                    @click:append="show1 = !show1"
                                >

                                </v-text-field>
                                <span>Ainda não tem conta? <span class="register" @click="register" style="color: red; cursor: pointer;"> Registe-se.</span></span>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn
                                type="submit"
                                small
                                elevation="4"
                                dark
                                color="secondary"
                                >
                                    Entrar
                                </v-btn>
                                <v-spacer></v-spacer>
                                <!-- <v-btn
                                depressed
								rounded
								text
								small
                                >
                                    Esqueceu a senha?
                                </v-btn> -->
                            </v-card-actions>

                    </v-form>
                </v-container>
            </v-card>
        </v-row>
        <loader/>
    </v-container>
</v-app>
</template>

<script>
import Loader from '../../loader/Loader.vue';
import Swal from "sweetalert2";
export default {
    components: {Loader},
    data() {
        return {
            formData: {
                email: '',
                password: ''
            },
            show1: false
        }
    },
    methods: {
        login() {
            console.log(this.formData);
            this.$store.dispatch('Auth/login', this.formData)
                .then(res => {
                    this.$router.push({name: 'colaboradores.data'})
                    console.log(res);
                }).catch(err => {
                    Swal.fire({
						title: "Emai e Senha Incorretos!",
						// html: `A sua conta foi registada!<br> Use as mesmas credenciais para fazer o login.`,
						icon: "erro",
						confirmButtonText: "Ok",
						confirmButtonColor: "#FF1744",
					})
                })
        },
        register() {
            this.$router.push({name: 'register'})
        }
    }
}
</script>

<style>

</style>
