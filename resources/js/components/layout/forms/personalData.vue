<template>
    <v-card>
          <!-- <v-card-title>
            <span class="text-h5">Ficha de Dados Pessoais</span>
          </v-card-title> -->
          <validation-observer
              ref="personalDataForm"
              v-slot="{  }">
              <v-form>
                  <v-card-text>
                      <v-container>
                          <v-row>
                          <v-col
                              cols="12"
                              sm="6"
                              md="6"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Nome completo"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Nome completo"
                                  outlined
                                  dense
                                  :error-messages="errors"
                                  v-model="personalDataForm.nome_completo"
                                  ></v-text-field>
                              </validation-provider>
                          </v-col>
                          <v-col cols="12" md="3">
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
                                              <validation-provider
                                                  v-slot="{ errors }"
                                                  name="Data de Nascimento"
                                                  rules="required"
                                              >
                                                  <v-text-field
                                                      outlined
                                                      dense
                                                      v-model="personalDataForm.data_nascimento"
                                                      label="Data de nacimento"
                                                      append-icon="mdi-calendar"
                                                      readonly
                                                      v-bind="attrs"
                                                      v-on="on"
                                                      :error-messages="errors"
                                                  ></v-text-field>
                                              </validation-provider>
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
                              <v-col
                              cols="12"
                              sm="4"
                              md="3"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Nuit"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Nuit"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.nuit"
                                  :error-messages="errors"
                                  ></v-text-field>
                              </validation-provider>
                          </v-col>
  
                          </v-row>
                          <v-row>
                              
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Genero"
                                      rules="required"
                                  >
                                      <v-select
                                      outlined
                                      dense
                                      :items="generos"
                                      label="Género"
                                      v-model="personalDataForm.genero"
                                      :error-messages="errors">
                                      </v-select>
                                  </validation-provider>
                          </v-col>
                          <v-col cols="12" md="4">
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Estado Civil"
                                  rules="required"
                              >
                                  <v-select
                                      outlined
                                      dense
                                      :items="estadoCivil"
                                      label="Estado Civíl"
                                      v-model="personalDataForm.estado_civil"
                                      :error-messages="errors">
                                  </v-select>
                              </validation-provider>
                          </v-col>
                          <v-col
                              cols="12"
                              md="4"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Nacionalidade"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Nacionalidade"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.nacionalidade"
                                  :error-messages="errors"
                                  ></v-text-field>
                              </validation-provider>
                          </v-col>    
                          </v-row>
                          <v-row>
                          
                          <v-col
                              cols="12"
                              md="4"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Tipo de Documento"
                                  rules="required"
                              >
                                  <v-select
                                  label="Tipo de Documento"
                                  :items="tipoDocumentos"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.tipo_documento"
                                  :error-messages="errors"
                                  ></v-select>
                              </validation-provider>
                          </v-col>
                          <v-col
                              cols="12"
                              md="4"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Numero do documento"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Número do Documento"
                                  outlined
                                  dense
                                  :error-messages="errors"
                                  v-model="personalDataForm.nr_documento"
                                  ></v-text-field>
                              </validation-provider>
                          </v-col>
                          <v-col cols="12" md="4">
                              <v-file-input
                              label="Anexar documento"
                              outlined
                              dense
                              v-model="documento"></v-file-input>
                          </v-col>
                          </v-row>
                          <v-divider class="mx-4"></v-divider>
                          <br>
                          <v-row>
                          <v-col
                              cols="12"
                              md="6"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Endereço"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Endereço"
                                  placeholder="Avenida, Rua, Praça"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.endereco"
                                  :error-messages="errors"
                                  ></v-text-field>
                              </validation-provider>
  
                          </v-col>
                              <v-col
                              cols="12"
                              md="4"
                          >
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Bairro"
                                  rules="required"
                              >
                                  <v-text-field
                                  label="Bairro"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.bairro"
                                  :error-messages="errors"
                                  ></v-text-field>
                              </validation-provider>
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
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Provincia"
                                      rules="required"
                                  >
                                      <v-text-field
                                      label="Provincia"
                                      outlined
                                      dense
                                      required
                                      :error-messages="errors"
                                      v-model="personalDataForm.provincia"
                                      ></v-text-field>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Numero do documento"
                                      rules="required"
                                  >
                                      <v-text-field
                                      label="Distrito"
                                      :error-messages="errors"
                                      outlined
                                      dense
                                      required
                                      v-model="personalDataForm.distrito"
                                      ></v-text-field>
                                  </validation-provider>
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
                              <validation-provider
                                  v-slot="{ errors }"
                                  name="Email profissiona"
                                  rules="required"
                              >
                                  <v-text-field
                                  :error-messages="errors"
                                  label="Email Profissional"
                                  outlined
                                  dense
                                  required
                                  v-model="personalDataForm.email"
                                  ></v-text-field>
                              </validation-provider>
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
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Celular"
                                      rules="required"
                                  >
                                      <v-text-field
                                      label="Celular"
                                      placeholder="8X1234567"
                                      outlined
                                      dense
                                      required
                                      :error-messages="errors"
                                      v-model="personalDataForm.contacto"
                                      ></v-text-field>
                                  </validation-provider>
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
              </v-form>
          </validation-observer>
        </v-card>
  </template>
  
  <script>
  import Axios from 'axios';
  import { BASE_URL } from '../../../config/api'
  import Swal from "sweetalert2";
  import {
      ValidationProvider,
      ValidationObserver,
      setInteractionMode,
      extend,
  } from "vee-validate";
  import { required, digits, email, confirmed,max, regex, integer } from "vee-validate/dist/rules";
  
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
      components: { ValidationObserver, ValidationProvider },
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
                      anexo_documento: "",
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
          },
          user_id: {
            required: true
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
              documento: null,
              date: new Date().toISOString().substr(0, 10),
              menu: false
          }
      },
      methods: {
          closeDialog() {
              this.$emit('closeDialog')
          },
          async save() {
            // this.$emit('next')
            // return
            //   await this.$emit('getUserId')
              const isValidAutoRegisterForm = await this.$refs.personalDataForm.validate();
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
              this.$store.state.Loader.loading = true
              const formData = new FormData();
              Object.keys(this.personalDataForm).forEach(key => formData.append(key, this.personalDataForm[key]))
              formData.append('user_id', this.user_id)
              // console.log(formData.get('nome_completo'));
              // return
              if (this.documento !== null && typeof(this.documento) !== 'string')
              formData.append("documeto", this.documento);
              if (this.personalDataForm.id !== null) {
                  Axios.post(`${BASE_URL}admin/employe/personal-data/${this.personalDataForm.id}`, formData)
                      .then(res => {
                          // console.log(res);
                          this.$store.state.Loader.loading = false
                          Swal.fire({
                              icon: 'success',
                              title: 'Dados atualizados com sucesso',
                              showConfirmButton: false,
                              timer: 1500
                          })
                          this.$emit('next')

                      })
                      .catch(err => {
                          console.log(err);
                      })
                  return
              }
              // console.log(this.personalDataForm);
              Axios.post(`${BASE_URL}admin/employe/personal-data`, formData)
                  .then(res => {
                      // console.log(res);
                      this.$store.state.Loader.loading = false
                      Swal.fire({
                          icon: 'success',
                          title: 'Dados guardados com sucesso',
                          showConfirmButton: false,
                          timer: 1500
                      })
                      this.$emit('next')
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
  