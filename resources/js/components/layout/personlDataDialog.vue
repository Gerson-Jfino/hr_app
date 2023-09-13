<template>
  <v-card>
        <!-- <v-card-title>
          <span class="text-h5">Ficha de Dados Pessoais</span>
        </v-card-title> -->
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="7"
              >
                <v-text-field
                  label="Nome completo"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.nome_completo"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="5"
              >
                <v-text-field
                  label="Nuit"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.nuit"
                ></v-text-field>
              </v-col>

            </v-row>
            <v-row>
                <v-col cols="12" md="4">
                    <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            :return-value.sync="date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="personalDataForm.data_nascimento"
                                    label="Data de nacimento"
                                    append-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="personalDataForm.data_nascimento"
                                dense
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu = false">
                                    Cancel
                                </v-btn>
                                <v-btn text color="primary" @click="$refs.menu.save(date)">
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                </v-col>
                <v-col cols="12" md="4">
                    <v-select
                    outlined
                    dense
                    :items="generos"
                    label="Género"
                    v-model="personalDataForm.genero">
                </v-select>
            </v-col>
            <v-col cols="12" md="4">
                <v-select
                    outlined
                    dense
                    :items="estadoCivil"
                    label="Estado Civíl"
                    v-model="personalDataForm.estado_civil">
                </v-select>
            </v-col>
            </v-row>
            <v-row>
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  label="Nacionalidade"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.nacionalidade"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-select
                  label="Tipo de Documento"
                  :items="tipoDocumentos"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.tipo_documento"
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  label="Número do Documento"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.nr_documento"
                ></v-text-field>
              </v-col>

            </v-row>
            <v-divider class="mx-4"></v-divider>
            <br>
            <v-row>
                <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  label="Endereço"
                  placeholder="Avenida, Rua, Praça"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.endereco"
                ></v-text-field>
              </v-col>
                <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  label="Bairro"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.bairro"
                ></v-text-field>
              </v-col>
                <v-col
                cols="12"
                md="2"
              >
                <v-text-field
                  label="Caixa Postal"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.cod_postal"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Provincia"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.provincia"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Distrito"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.distrito"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Cidade / Localidade"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.cidade"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider class="mx-4"></v-divider>
            <br>
            <v-row>
                <v-col
                cols="12"
                sm="6"
                md="7"
              >
                <v-text-field
                  label="Email Profissional"
                  outlined
                  dense
                  required
                  v-model="personalDataForm.email"
                ></v-text-field>
              </v-col>
                <v-col
                cols="12"
                md="5"
              >
                <v-text-field
                  label="Email Alternativo  "
                  outlined
                  dense
                  required
                  v-model="personalDataForm.email_sec"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Celular"
                    placeholder="8X1234567"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.contacto"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Celular Alternativo"
                    placeholder="8X1234567"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.contacto_sec"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Cel / Tel"
                    placeholder="2X123456"
                    outlined
                    dense
                    required
                    v-model="personalDataForm.cell"
                    ></v-text-field>
                </v-col>
            </v-row>
          </v-container>
          <small>* Indica que o campo é o obrigatorio</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            class="ma-4"
            color="error"
            outlined
            small
            @click="closeDialog()"
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
            small
            @click="save()"
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
                    nome_completo: "",
                    nuit: "",
                    data_nascimento: null,
                    genero: "",
                    estado_civil: "",
                    nacionalidade: "",
                    tipo_documento: "",
                    nr_documento: "",
                    endereco: "",
                    bairro: "",
                    cod_postal: "",
                    provincia: "",
                    distrito: "",
                    cidade: "",
                    email: "",
                    email_sec: "",
                    contacto: "",
                    contacto_sec: "",
                    cell: ""
                }
            }
        }
    },
    data() {
        return {
            tipoDocumentos:[
                "Bilhete de Identidade",
                "Carta de Condução"
            ],
            generos: [
                "FEMININO",
                "MASCULINO"
            ],
            estadoCivil: [
                "Solteiro(A)",
                "Casado(A)",
                "Divorciado(A)",
                "Viúvo(A)",
            ],
            date: new Date().toISOString().substr(0, 10),
            menu: false
        }
    },
    methods: {
        closeDialog() {
            this.$emit('closeDialog')
        },
        save() {
            this.$store.state.Loader.loading = true
            if (this.personalDataForm.id !== null) {
                Axios.post(`${BASE_URL}employe/personal-data/${this.personalDataForm.id}`, this.personalDataForm)
                    .then(res => {
                        // console.log(res);
                        this.$store.state.Loader.loading = false
                        this.$emit('savedPersonalCloseDialog')
                    })
                    .catch(err => {
                        console.log(err);
                    })
                return
            }
            // console.log(this.personalDataForm);
            Axios.post(`${BASE_URL}employe/personal-data`, this.personalDataForm)
				.then(res => {
					// console.log(res);
                    this.$store.state.Loader.loading = false
                    this.$emit('savedPersonalCloseDialog')
				})
				.catch(err => {
					console.log(err);
				})
        }
    }
}
</script>

<style>

</style>
