<template>
    <v-card>
        <validation-observer
            ref="educationForm"
            v-slot="{  }">
            <v-form>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="7">
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Curso"
                                    rules="required"
                                >
                                    <v-text-field
                                        label="Curso"
                                        outlined
                                        dense
                                        required
                                        v-model="personalDataForm.curso"
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="12" md="5">
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Nivel Academico"
                                    rules="required"
                                >
                                    <v-select
                                        outlined
                                        dense
                                        label="Nivel Academico"
                                        item-text="name"
                                        item-value="id"
                                        :items="nivel"
                                        :error-messages="errors"
                                        v-model="personalDataForm.nivel_id"
                                    >
                                    </v-select>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="7">
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Instituição"
                                    rules="required"
                                >
                                    <v-text-field
                                    label="Instituição"
                                    outlined
                                    dense
                                    placeholder="Nome da instituição, universidade ou escola"
                                    v-model="personalDataForm.instituicao"
                                    :error-messages="errors">
                                    </v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="12" md="5">
                                <v-file-input
                                label="Carregar anexo"
                                outlined
                                dense
                                v-model="anexoAtach"></v-file-input>
                            </v-col>
                        </v-row>

                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                    class="ma-4"
                    color="error"
                    outlined
                    small
                    @click="closeDialog"
                    >
                    <v-icon small>
                        mdi-cancel
                    </v-icon>
                    Cancelar
                    </v-btn>
                    <v-btn
                    class="ma-4"
                    outlined
                    color="success"
                    @click="save"
                    >
                    <v-icon small>
                        mdi-checkbox-marked-circle
                    </v-icon>
                    Guardar
                    </v-btn>
                </v-card-actions>
            </v-form>
        </validation-observer>
    </v-card>
</template>

<script>
import Axios from 'axios';
import { BASE_URL } from '../../config/api'
import Swal from "sweetalert2";
import {
	ValidationProvider,
	ValidationObserver,
	setInteractionMode,
	extend,
} from "vee-validate";
import { required, digits, email, confirmed,max, regex } from "vee-validate/dist/rules";

setInteractionMode("eager");

extend("required", {
	...required,
	message: "{_field_} não pode estar vazio!",
});

extend("digits", {
	...digits,
	message: "{_field_} deve conter {length} dígitos. ({_value_})!",
});

extend("email", {
	...email,
	message: "O email deve ser válido!",
});
extend("confirmed", {
	...confirmed,
	message: "O valor para o campo {_field_} não coincide!",
});
export default {
    components: { ValidationObserver, ValidationProvider},
    props: {
        personalDataForm: {
            type: Object,
            required: false,
            default() {
                return {
                    id: null,
                    nivel_id: null,
                    curso: "",
                    instituicao: "",
                    anexo: null
                }
            }
        }
    },
    data() {
        return {
            anexos: [
                'Certificado',
                'Diploma'
            ],
            nivel: [
            ],
            anexoAtach: null
        }
    },
    created() {
        this.getCompanyData()
    },
    methods: {
        async getCompanyData() {
            this.$store.state.Loader.loading = true
            const companyData = await Axios.get(`${BASE_URL}pelouros`)
            this.nivel = companyData.data.nivel;
            this.$store.state.Loader.loading = false

        },
        async save() {
            const isValidAutoRegisterForm = await this.$refs.educationForm.validate();
            if(!isValidAutoRegisterForm) {
                Swal.fire({
					title: "Alerta de Validação!",
					html: `Preencha todos os campos corretamente.`,
					icon: "warning",
					confirmButtonText: "Ok",
					confirmButtonColor: "#FF4500",
				});

				return;
            }
            // console.log(this.personalDataForm);
            this.$store.state.Loader.loading = true
            const formData = new FormData();
            formData.append('nivel_id', this.personalDataForm.nivel_id)
            formData.append('curso', this.personalDataForm.curso)
            formData.append('instituicao', this.personalDataForm.instituicao)
            if (this.anexoAtach !== null && typeof(this.anexoAtach) !== 'string' ) {
                formData.append('anexo', this.anexoAtach)
            }
            if (this.personalDataForm.id !== null) {
                Axios.post(`${BASE_URL}employe/nivel-academico/${this.personalDataForm.id}`, formData)
                    .then(res => {
                        // console.log(res);
                        this.$store.state.Loader.loading = false
                        Swal.fire({
                            icon: 'success',
                            title: 'Dados atualizada com sucesso',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.$emit('savedEducationlCloseDialog')
                    })
                    .catch(err => {
                        console.log(err);
                    })
                return
            }
            // console.log(this.personalDataForm);
            Axios.post(`${BASE_URL}employe/nivel-academico`, formData)
				.then(res => {
					// console.log(res);
                    this.$store.state.Loader.loading = false
                    Swal.fire({
                        icon: 'success',
                        title: 'Dados guardada com sucesso',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$emit('savedEducationlCloseDialog')
				})
				.catch(err => {
					console.log(err);
				})
        },
        closeDialog() {
            this.$emit('closeDialogAcademic')
        }
    }
}
</script>

<style>

</style>
