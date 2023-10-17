<template>
    <v-card>
          <!-- <v-card-title>
            <span class="text-h5">Ficha de Dados Pessoais</span>
          </v-card-title> -->
          <validation-observer
              ref="personalDataForm"
              v-slot="{  }">
              <v-form @submit.prevent="save">
                  <v-card-text>
                      <v-container>
                          <v-row>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Nome Completo"
                                      rules="required"
                                  >
                                      <v-text-field
                                          label="Nome Completo"
                                          outlined
                                          dense
                                          v-model="personalDataForm.nome_completo"
                                          :error-messages="errors"
                                      ></v-text-field>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Situação"
                                      rules="required"
                                  >
                                  <v-select
                                      outlined
                                      dense
                                      label="Situação"
                                      :items="data.situation"
                                      item-text="name"
                                      item-value="id"
                                      v-model="personalDataForm.situation_id"
                                      :error-messages="errors"
                                  >
                                  </v-select>
                                  </validation-provider>
                              </v-col>
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
                                          <validation-provider
                                              v-slot="{ errors }"
                                              name="Data situação"
                                              rules="required"
                                          >
                                              <v-text-field
                                                  outlined
                                                  dense
                                                  v-model="personalDataForm.data_situacao"
                                                  label="Data da situação"
                                                  append-icon="mdi-calendar"
                                                  readonly
                                                  v-bind="attrs"
                                                  v-on="on"
                                                  :error-messages="errors"
                                              ></v-text-field>
                                          </validation-provider>
                                      </template>
                                      <v-date-picker
                                          v-model="personalDataForm.data_situacao"
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
                          </v-row>
                          <v-row>
  
                              <v-col cols="12" md="4">
                                  <v-menu
                                      ref="menu2"
                                      v-model="menu2"
                                      :close-on-content-click="false"
                                      :return-value.sync="date"
                                      transition="scale-transition"
                                      offset-y
                                      min-width="auto"
                                  >
                                      <template v-slot:activator="{ on, attrs }">
                                          <validation-provider
                                              v-slot="{ errors }"
                                              name="Data admissão"
                                              rules="required"
                                          >
                                              <v-text-field
                                                  outlined
                                                  dense
                                                  v-model="personalDataForm.data_admissao"
                                                  label="Data da admissão"
                                                  append-icon="mdi-calendar"
                                                  readonly
                                                  v-bind="attrs"
                                                  v-on="on"
                                                  :error-messages="errors"
                                              ></v-text-field>
                                          </validation-provider>
                                      </template>
                                      <v-date-picker
                                          v-model="personalDataForm.data_admissao"
                                          dense
                                          no-title
                                          scrollable
                                      >
                                          <v-spacer></v-spacer>
                                          <v-btn text color="primary" @click="menu2 = false">
                                              Cancel
                                          </v-btn>
                                          <v-btn text color="primary" @click="$refs.menu2.save(date)">
                                              OK
                                          </v-btn>
                                      </v-date-picker>
                                  </v-menu>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <v-menu
                                      ref="menu3"
                                      v-model="menu3"
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
                                              v-model="personalDataForm.data_fim"
                                              label="Data Fim"
                                              append-icon="mdi-calendar"
                                              readonly
                                              v-bind="attrs"
                                              v-on="on"
                                          ></v-text-field>
                                      </template>
                                      <v-date-picker
                                          v-model="personalDataForm.data_fim"
                                          dense
                                          no-title
                                          scrollable
                                      >
                                          <v-spacer></v-spacer>
                                          <v-btn text color="primary" @click="menu3 = false">
                                              Cancel
                                          </v-btn>
                                          <v-btn text color="primary" @click="$refs.menu3.save(date)">
                                              OK
                                          </v-btn>
                                      </v-date-picker>
                                  </v-menu>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="INSS"
                                      rules="required"
                                  >
                                      <v-text-field
                                          label="INSS"
                                          outlined
                                          dense
                                          v-model="personalDataForm.inss"
                                          :error-messages="errors">
                                      </v-text-field>
                                  </validation-provider>
                              </v-col>
                          </v-row>
                          <v-row>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Categoria"
                                      rules="required"
                                  >
                                      <v-select
                                          label="Categoria"
                                          outlined
                                          dense
                                          :items="data.categoria"
                                          item-text="name"
                                          item-value="id"
                                          v-model="personalDataForm.categoria_id"
                                          :error-messages="errors">
                                      </v-select>
                                  </validation-provider>
                              </v-col>
  
                              <!-- <v-col cols="12" md="4">
                                  <v-select
                                      label="Sector"
                                      outlined
                                      dense>
  
                                  </v-select>
                              </v-col> -->
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Nivel Acedemico"
                                      rules="required"
                                  >
                                      <v-select
                                          label="Nivel Academico"
                                          outlined
                                          dense
                                          :items="data.nivel"
                                          item-text="name"
                                          item-value="id"
                                          v-model="personalDataForm.nivel_id"
                                          :error-messages="errors">
                                      </v-select>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Salario"
                                      rules="required"
                                  >
                                      <v-text-field
                                          label="Salario"
                                          outlined
                                          dense
                                          v-model="personalDataForm.salario"
                                          :error-messages="errors">
                                      </v-text-field>
                                  </validation-provider>
                              </v-col>
                          </v-row>
                          <v-row>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Pelouro"
                                      rules="required"
                                  >
                                      <v-select
                                          label="Pelouro"
                                          outlined
                                          dense
                                          :items="data.pelouros"
                                          item-text="name"
                                          item-value="id"
                                          v-model="pelouro_id"
                                          :error-messages="errors">
                                      </v-select>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Unidade Organica"
                                      rules="required"
                                  >
                                      <v-select
                                          label="Unidade Organica"
                                          outlined
                                          dense
                                          :items="data.uni_org_filtered"
                                          item-text="name"
                                          item-value="id"
                                          v-model="uni_org_id"
                                          :error-messages="errors">
  
                                      </v-select>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="4">
                                  <validation-provider
                                      v-slot="{ errors }"
                                      name="Sector"
                                      rules="required"
                                  >
                                      <v-select
                                          label="Sector"
                                          outlined
                                          dense
                                          :items="data.sector_filtered"
                                          item-text="name"
                                          item-value="id"
                                          v-model="sector_id"
                                          :error-messages="errors">
                                      </v-select>
                                  </validation-provider>
                              </v-col>
                              <v-col cols="12" md="5">
                                  <v-file-input
                                  label="Anexar curriculum"
                                  outlined
                                  dense
                                  v-model="documento"></v-file-input>
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
                      @click="closeDialogCompany()"
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
                      type="submit"
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
      components: { ValidationProvider, ValidationObserver },
      props: {
          personalDataForm: {
              type: Object,
              required: false,
              default() {
                  return {
                      id: null,
                      nome_completo: "",
                      data_situacao: null,
                      data_admissao: null,
                      data_fim: null,
                      nivel_id: null,
                      situation_id: null,
                      categoria_id: null,
                      pelouro_id: null,
                      uni_org_id: null,
                      sector_id: null,
                      salario: "",
                      inss: "",
                      contrato: ""
                  }
              }
          },
          user_id: {
            required: true
          }
      },
      data() {
          return {
              // personalDataForm: {
              //     id: null,
              //     nome_completo: "",
              //     data_situacao: null,
              //     data_admissao: null,
              //     data_fim: null,
              //     nivel_id: null,
              //     situation_id: null,
              //     categoria_id: null,
              //     pelouro_id: null,
              //     uni_org_id: null,
              //     sector_id: null,
              //     salario: ""
              // },
              pelouro_id: null,
              uni_org_id: null,
              sector_id: null,
              situacoes: ['Ativo', 'Reforma', 'Rescisão', 'Falecimento'],
              categorias: ['Support', 'Profissional I', 'Profissional II', 'Senior'],
              data: {
                  pelouros: [],
                  uni_org: [],
                  uni_org_filtered: [],
                  sector: [],
                  sector_filtered: [],
                  nivel: [],
                  categoria: [],
                  situation: []
              },
              menu: false,
              menu2: false,
              menu3: false,
              date: new Date().toISOString().substr(0, 10),
              documento: null
  
          }
      },
      created() {
          if (this.personalDataForm.id !== null) {
              if (this.personalDataForm.pelouro_id !== null) {
                  this.pelouro_id = this.personalDataForm.pelouro_id
              }
              if (this.personalDataForm.uni_org_id !== null) {
                  this.uni_org_id = this.personalDataForm.uni_org_id
              }
              if (this.personalDataForm.pelouro_id !== null) {
                  this.sector_id = this.personalDataForm.sector_id
              }
          }
          this.getCompanyData()
      },
      computed: {
          filteredUniOrg() {
              console.log(this.data.uni_org.filter(uni => uni.pelouro_id == personalCompanyData.pelouro_id));
              return this.data.uni_org.filter(uni => uni.pelouro_id == personalCompanyData.pelouro_id)
          }
      },
      methods: {
          closeDialogCompany() {
              this.$emit('closeCompanyDialig')
          },
          async getCompanyData() {
              this.$store.state.Loader.loading = true
              const companyData = await Axios.get(`${BASE_URL}pelouros`)
              this.data.pelouros = companyData.data.pelouros;
              this.data.uni_org = companyData.data.uni_org;
              this.data.sector = companyData.data.sector;
              this.data.nivel = companyData.data.nivel;
              this.data.categoria = companyData.data.categoria;
              this.data.situation = companyData.data.situation;
              if (this.pelouro_id !== null) {
                  this.data.uni_org_filtered = this.data.uni_org.filter(uni => uni.pelouro_id == this.pelouro_id)
              }
              if (this.uni_org_id !== null) {
                  this.data.sector_filtered = this.data.sector.filter(sec => sec.uni_org_id == this.uni_org_id)
              }
              this.$store.state.Loader.loading = false
              console.log(companyData.data);
  
          },
          async save() {
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
              this.personalDataForm.pelouro_id = this.pelouro_id
              this.personalDataForm.uni_org_id = this.uni_org_id
              this.personalDataForm.sector_id = this.sector_id
              const formData = new FormData();
              Object.keys(this.personalDataForm).forEach(key => formData.append(key, this.personalDataForm[key]))
              if (typeof(this.documento) !== 'string' && this.documento !== null) {
                  formData.append("documeto", this.documento);
              }
              formData.append('user_id', this.user_id)
              if (this.personalDataForm.id !== null) {
                  Axios.post(`${BASE_URL}admin/employe/company-data/${this.personalDataForm.id}`, formData)
                      .then(res => {
                          // console.log(res);
                          this.$store.state.Loader.loading = false
                          Swal.fire({
                              icon: 'success',
                              title: 'Dados atualziada com sucesso',
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
              Axios.post(`${BASE_URL}admin/employe/company-data`, formData)
                  .then(res => {
                      console.log(res);
                      Swal.fire({
                          icon: 'success',
                          title: 'Dados guardada com sucesso',
                          showConfirmButton: false,
                          timer: 1500
                      })
                      this.$store.state.Loader.loading = false
                      this.$emit('next')
                  })
                  .catch(err => {
                      console.log(err);
                  })
              // console.log(this.personalDataForm);
          }
  
      },
      watch: {
          pelouro_id(id) {
              // console.log(id);
              this.data.uni_org_filtered = this.data.uni_org.filter(uni => uni.pelouro_id == id)
          },
          uni_org_id(id) {
              this.data.sector_filtered = this.data.sector.filter(sec => sec.uni_org_id == id)
          },
          personalDataForm(personal) {
              this.pelouro_id = personal.pelouro_id
              // this.data.uni_org_filtered = this.data.uni_org.filter(uni => uni.pelouro_id == personal.pelouro_id)
              this.uni_org_id = personal.uni_org_id
              // this.data.sector_filtered = this.data.sector.filter(sec => sec.uni_org_id == personal.uni_org_id)
              this.sector_id = personal.sector_id
              console.log('any');
          }
      }
  }
  </script>
  
  <style>
  
  </style>
  