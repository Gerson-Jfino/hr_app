<template>
    <v-card>
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12" md="7">
                        <v-text-field
                            label="Curso"
                            outlined
                            dense
                            required
                            v-model="personalDataForm.curso"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="5">
                        <v-select
                            outlined
                            dense
                            label="Nivel Academico"
                            item-text="name"
                            item-value="id"
                            :items="nivel"
                            v-model="personalDataForm.nivel_id"
                        >
                        </v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="7">
                        <v-text-field
                        label="Instituição"
                        outlined
                        dense
                        placeholder="Nome da instituição, universidade ou escola"
                        v-model="personalDataForm.instituicao">
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="5">
                        <v-file-input
                        label="Carregar anexo"
                        outlined
                        dense
                        v-model="personalDataForm.anexo"></v-file-input>
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
    </v-card>
</template>

<script>
import Axios from 'axios';
import { BASE_URL } from '../../config/api'
export default {
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
            ]
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
        save() {
            // console.log(this.personalDataForm);
            this.$store.state.Loader.loading = true
            const formData = new FormData();
            formData.append('nivel_id', this.personalDataForm.nivel_id)
            formData.append('curso', this.personalDataForm.curso)
            formData.append('instituicao', this.personalDataForm.instituicao)
            if (this.personalDataForm.anexo !== null && typeof this.personalDataForm.anexo !== "string") {
                formData.append('anexo', this.personalDataForm.anexo)
            }
            if (this.personalDataForm.id !== null) {
                Axios.post(`${BASE_URL}employe/nivel-academico/${this.personalDataForm.id}`, formData)
                    .then(res => {
                        // console.log(res);
                        this.$store.state.Loader.loading = false
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
