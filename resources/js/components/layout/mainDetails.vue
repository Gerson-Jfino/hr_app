<template>
  <v-app id="inspire">
    <v-main class="grey lighten-3">
      <v-container>
        <v-row >
          <v-col cols="4" class="me-4">
            <!-- <v-sheet rounded="lg"> -->
              <v-card max-width="450px">
                <v-divider></v-divider>
                <v-card-title>
                  <v-row align="center">
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: 20px"
                    >
                      <v-avatar
                        class="profile avatar-center-heigth avatar-shadow"
                        color="grey"
                        size="60"
                      >
                        <span style="color: aliceblue">{{ initialsNameUser }}</span>
                      </v-avatar>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                    >
                      <div class="grey--text ms-1" v-if="personal_data?.id">cod: {{ personal_data.id }}</div>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <v-card-title
                        ><strong> {{ personal_data?.nome_completo }}</strong></v-card-title
                      >
                    </v-col>
                    <!-- <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <div class="grey--text ms-4" style="font-size: small">
                        Direção de Tecnlogia de Informatica
                      </div>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <div class="" style="font-size: small">
                        Pelouro de De destribuição Comercial e Informatica
                      </div>
                    </v-col> -->
                  </v-row>
                </v-card-title>
                <v-divider class="mx-4"></v-divider>

                <v-card-text>
                  <v-row>
                    <v-card-title class="orange--text"> Dados Pessoais </v-card-title>
                    <v-btn
                    class="ma-4"
                    color="error"
                    outlined
                    small
                      @click="dialog = true"
                    >
                      <v-icon small>mdi-pencil</v-icon>
                      Editar
                    </v-btn>

                    <v-dialog v-model="dialog" persistent max-width="900px">
                      <v-toolbar color="secondary" dark>
                        <v-row> Ficha de Dados Pessoais </v-row>
                      </v-toolbar>
                      <personl-data-dialog :personalDataForm="personal_data" @closeDialog="closePesonalForm" @savedPersonalCloseDialog="savedPersonalCloseDialog"/>
                    </v-dialog>
                  </v-row>

                  <!-- <v-row
                        align="center"
                        class="mx-0"
                    >
                        <v-rating
                        :value="4.5"
                        color="amber"
                        dense
                        half-increments
                        readonly
                        size="14"
                        ></v-rating>

                        <div class="grey--text ms-4">
                        4.5 (413)
                        </div>
                    </v-row> -->
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon style="margin-top: 2px">
                        mdi-cake-variant
                      </v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.data_nascimento | formatDate }}</span
                      ><br />
                      <span
                        class="grey--text ms-4"
                        style="font-size: small; margin-top: -20px"
                        v-if="personal_data?.data_nascimento">{{ personal_data?.data_nascimento | getAge }} Anos</span
                      >
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-account-box </v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.nacionalidade }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.genero }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        v-if="personal_data?.nuit">NUIT: {{ personal_data?.nuit }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        v-if="personal_data?.nr_documento" >{{ personal_data?.tipo_documento }}: {{ personal_data?.nr_documento }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"><a :href="personal_data?.anexo_documento">Ver Documento</a></span>
                    </v-col>
                  </v-row>

                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-map-marker</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        v-if="personal_data?.cidade">Cidade de {{ personal_data?.cidade }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.endereco }}, {{ personal_data?.provincia }} {{ personal_data?.bairro }}</span
                      ><br />
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-cellphone</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.contacto }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        v-if="personal_data?.contacto_sec">{{ personal_data?.contacto_sec }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        v-if="personal_data?.cell">{{ personal_data?.cell }}</span
                      ><br />
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-email</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.email }}</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >{{ personal_data?.email_sec }}</span
                      ><br />
                    </v-col>
                  </v-row>
                </v-card-text>

                <v-divider class="mx-4"></v-divider>
              </v-card>
            <!-- </v-sheet> -->
          </v-col>

          <v-col style="margin-top: 15px;">
            <v-sheet rounded="lg">
              <v-card>
                <v-row>
                  <v-card-title class="orange--text" style="margin-left: 5px;">Dados Empresariais </v-card-title>
                  <v-btn
                    class="ma-4"
                    color="error"
                    outlined
                    small
                    @click="
                      () => {
                        dialogCompany = true;
                      }
                    "
                  >
                    <v-icon small>mdi-pencil</v-icon>
                    Editar
                  </v-btn>
                  <v-dialog
                    v-model="dialogCompany"
                    persistent
                    max-width="900px"
                  >
                    <v-toolbar color="secondary" dark>
                      <v-row> Ficha de Dados Empresariais </v-row>
                    </v-toolbar>
                    <company-data-dialog
                        :personal-data-form="employee"
                        @savedCloseDialog="savedCompanyDialog"
                        @closeCompanyDialig="closeCompanyDialig"
                    />
                  </v-dialog>
                </v-row>
                <v-row>
                  <v-card-text>
                    <div class="font-weight-bold ml-8 mb-2">
                      Codigo Trabalhador: {{ employee.id }}
                    </div>
                    <v-timeline align-top dense>
                      <v-timeline-item
                        color="orange"
                        small
                        style="margin-top: -30px"
                      >
                        <div class="grey--text" style="font-size: small">
                          {{ employee?.pelouro?.name }}
                          &#x2022; {{ employee?.uni_org?.name }}
                        </div>
                        <div class="grey--text" style="font-size: small">
                          &#x2022; {{ employee?.sector?.name }}
                        </div>
                        <div class="font-weight-normal">
                          <strong>{{ employee?.nome_completo }}</strong> &#x2022;
                          <span class="grey--text"> {{ employee?.categoria?.name }} </span>
                        </div>
                        <div><strong>{{ employee?.nivel?.name }}</strong></div>
                        <div>
                          <div
                            class="font-weight-normal"
                            style="font-size: small"
                          >
                            <strong>Data inicio</strong> &#x2022; {{ employee.data_admissao | formatDate }} -
                            <strong>Data inicio</strong> &#x2022; {{ employee.data_fim | formatDate }}
                          </div>
                          <div>
                            <strong>{{ employee?.situation?.name }}</strong> &#x2022; {{ employee.data_situacao | formatDate }}
                          </div>
                          <div>
                            <strong>SALARIO: </strong> {{ employee.salario }}
                          </div>
                          <div>
                            <strong>INSS: </strong> {{ employee.inss }}
                          </div>
                          <div v-if="employee.contrato">
                            <span class="grey--text" style="font-size: small"><a :href="employee.contrato" target="__blank">Ver contrato</a></span>
                          </div>
                          <div v-if="empDocs.length > 0">
                            <strong>Outros documentos: </strong> <span v-for="doc in empDocs" :key="doc.id"><a :href="doc.anexo" target="_blank">{{ doc.name }}</a></span>
                          </div>
                          <div v-if="employee.id" style="margin-top: 20px;">
                            
                            <v-row>
                              <v-dialog
                                v-model="dialogPersonalDocs"
                                persistent
                                max-width="600px"
                              >
                                <template v-slot:activator="{ on, attrs }">
                                  <v-btn
                                    color="primary"
                                    dark
                                    small
                                    outlined
                                    v-bind="attrs"
                                    v-on="on"
                                  >
                                        <v-icon left>
                                      mdi-plus
                                    </v-icon>
                                    documento
                                  </v-btn>
                                </template>
                                <v-card>
                                  <v-card-title>
                                    <span class="text-h5">Anexar outros documentos</span>
                                  </v-card-title>
                                  <v-card-text>
                                    <v-container>
                                      <v-row>
                                        <v-col
                                          cols="12"
                                          md="6"
                                        >
                                          <v-select
                                            label="Tipo de documento"
                                            :items="['Bilhete de Identidade', 'Carta de Condução', 'Nuit', 'Outro']"
                                            v-model="newDocPersonal.name"
                                            required
                                          ></v-select>
                                        </v-col>
                                        <v-col
                                          cols="12"
                                          md="6"
                                        >
                                        <v-col
                                            cols="12"
                                        >
                                        <!-- v-model="editedItem.protein" -->
                                          <v-file-input
                                          label="Anexar o documento"
                                          outlined
                                          dense
                                          v-model="newDocPersonal.anexo"></v-file-input>
                                        </v-col>
                                        </v-col>
                                      </v-row>
                                    </v-container>
                                  </v-card-text>
                                  <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                      color="blue darken-1"
                                      text
                                      @click="dialogPersonalDocs = false"
                                    >
                                      Cancelar
                                    </v-btn>
                                    <v-btn
                                      color="blue darken-1"
                                      text
                                      @click="SaveDocEmployee()"
                                    >
                                      Adicionar
                                    </v-btn>
                                  </v-card-actions>
                                </v-card>
                              </v-dialog>
                            </v-row>
                          </div>

                        </div>
                      </v-timeline-item>
                    </v-timeline>
                  </v-card-text>
                </v-row>
                <v-divider class="mx-4" style="margin-top: 30px;"></v-divider>
                <v-row wrap style="margin-top: 10px; margin-left: 5px;">
                    <!-- <v-row>

                    </v-row> -->
                    <!-- <br> -->
                    <v-row wrap>
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="2">
                                    <v-card-title class="orange--text" style="margin-left: 5px;">Educação </v-card-title>
                                </v-col>
                                <v-col cols="2">
                                    <v-btn
                                        class="ma-4"
                                        color="error"
                                        outlined
                                        small
                                        @click="
                                        () => {
                                            dialogEducation = true;
                                        }
                                        "
                                    >
                                        <v-icon small>mdi-pencil</v-icon>
                                        Editar
                                    </v-btn>
                                    <v-dialog
                                        v-model="dialogEducation"
                                        persistent
                                        max-width="900px"
                                    >
                                        <v-toolbar color="secondary" dark>
                                        <v-row> Educação </v-row>
                                        </v-toolbar>
                                        <education-data-dialog :personal-data-form="nivel_academico" @closeDialogAcademic="closeAcademicDialog" @savedEducationlCloseDialog="savedEducationCloseDialog"
                                        />
                                    </v-dialog>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col cols="12" style="margin-top: -25px;">
                            <v-card-text>
                                <v-timeline
                                    align-top
                                    dense
                                    style="margin-left: -20px;"
                                >
                                    <v-timeline-item small color="grey">
                                        <div class="blue--text"><strong><u> {{ nivel_academico?.curso }}</u></strong></div>
                                        <div class="black--text" style="font-size: small">
                                            &#x2022; <v-icon small>mdi-account-school</v-icon> {{ nivel_academico?.nivel?.name }}
                                        </div>
                                        <div class="grey--text">{{ nivel_academico?.instituicao }}</div>
                                        <div v-if="eduDocs.length > 0">
                                          <strong>Certificações: </strong> <span v-for="doc in eduDocs" :key="doc.id"><a :href="doc.anexo" target="_blank">{{ doc.name }}</a></span>
                                        </div>
                                    </v-timeline-item>
                                </v-timeline>
                                <div class="grey--text" style="margin-left: 15px; margin-top: 5px;">
                                    anexo
                                </div>
                                <div style="margin-left: 15px;" class="fileajjust" v-if="nivel_academico?.anexo">
                                    <div>
                                        <v-icon large>
                                            mdi-file-document
                                        </v-icon>
                                    </div>
                                    <div><a :href="nivel_academico?.anexo" target="_blank"> Baixar Anexo</a></div>
                                </div>
                                <div v-if="employee.id" style="margin-top: 20px;">
                            
                                  <v-row>
                                    <v-dialog
                                      v-model="dialogEducationDocs"
                                      persistent
                                      max-width="600px"
                                    >
                                      <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                          color="primary"
                                          dark
                                          small
                                          outlined
                                          v-bind="attrs"
                                          v-on="on"
                                        >
                                              <v-icon left>
                                            mdi-plus
                                          </v-icon>
                                          certificaçãoes
                                        </v-btn>
                                      </template>
                                      <v-card>
                                        <v-card-title>
                                          <span class="text-h5">Anexar outras certificações</span>
                                        </v-card-title>
                                        <v-card-text>
                                          <v-container>
                                            <v-row>
                                              <v-col
                                                cols="12"
                                                md="6"
                                              >
                                                <v-text-field
                                                  label="Nome da certificação"
                                                  v-model="newDocEduc.name"
                                                  required
                                                ></v-text-field>
                                              </v-col>
                                              <v-col
                                                cols="12"
                                                md="6"
                                              >
                                              <v-col
                                                  cols="12"
                                              >
                                              <!-- v-model="editedItem.protein" -->
                                                <v-file-input
                                                label="Anexar o documento"
                                                outlined
                                                dense
                                                v-model="newDocEduc.anexo"></v-file-input>
                                              </v-col>
                                              </v-col>
                                            </v-row>
                                          </v-container>
                                        </v-card-text>
                                        <v-card-actions>
                                          <v-spacer></v-spacer>
                                          <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="dialogEducationDocs = false"
                                          >
                                            Cancelar
                                          </v-btn>
                                          <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="SaveDocEdu()"
                                          >
                                            Adicionar
                                          </v-btn>
                                        </v-card-actions>
                                      </v-card>
                                    </v-dialog>
                                  </v-row>
                                </div>
                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-row>
              </v-card>
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import axios from 'axios'
import { BASE_URL } from '../../config/api'
import Swal from "sweetalert2"
import companyDataDialog from "./companyDataDialog.vue";
import personlDataDialog from "./personlDataDialog.vue";
import educationDataDialog from './educationDataDialog.vue';
export default {
  components: { personlDataDialog, companyDataDialog, educationDataDialog },
  data: () => ({
    links: ["Dashboard", "Messages", "Profile", "Updates"],
    dialog: false,
    dialogCompany: false,
    dialogEducation: false,
    dialogPersonalDocs: false,
    dialogEducationDocs: false,
    initialsNameUser: "",
    employee: {
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
        documento: [],
        inss: "",
        salario: "",
        contrato: ""
    },
    newDocPersonal: {
      name: "",
      anexo: null,
      type: 1
    },
    newDocEduc: {
      name: "",
      anexo: null,
      type: 2
    },
    allDocs: [],
    empDocs: [],
    eduDocs: [],
    personal_data: {
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
    },
    nivel_academico: {
        id: null,
        nivel_id: null,
        curso: "",
        instituicao: "",
        anexo: null
    }

  }),
	computed: {
		user() {
			const user = this.$store.state.Auth.user
      this.initialsNameUser = user.name.split(' ')[0].charAt(0) + user.name.split(' ')[user.name.split(' ').length - 1].charAt(0)
      // console.log(user.name.split(' ')[0].charAt(0) + user.name.split(' ')[user.name.split(' ').length - 1].charAt(0));
			return user
		}
	},
  created() {
    this.getMe()
  },
  methods: {
    closePesonalForm() {
      this.dialog = false;
    },
    closeCompanyDialig() {
      this.dialogCompany = false;
    },
    closeAcademicDialog() {
        this.dialogEducation = false
    },
    savedEducationCloseDialog() {
        this.dialogEducation = false
        this.getMe()
    },
    savedCompanyDialog() {
        this.dialogCompany = false;
        this.getMe()
    },
    savedPersonalCloseDialog() {
        this.dialog = false
        this.getMe()
    },
    async getMe() {
        const config = {
            headers: {
                Authorization: `Bearer ${sessionStorage.getItem('TOKEN_AUTH')}`,
            }
        }
        this.$store.state.Loader.loading = true
        try {
            const me = (await axios.get(`${BASE_URL}getMe`)).data
            if (me.employee) {
                this.employee = me.employee
            }
            if (me.personal_data) {
                this.personal_data = me.personal_data
            }
            if (me.nivel_academico) {
                this.nivel_academico = me.nivel_academico
            }
            if (me.employee && me.employee.documento) {
              this.empDocs = me.employee?.documento.filter(doc => doc.type == 1)
              this.eduDocs = me.employee?.documento.filter(doc => doc.type == 2)
            }
            // console.log(this.employee);
            this.$store.state.Loader.loading = false
        } catch (error) {
            console.log(error);
            this.$router.push({name: 'login'})
        }
    },
    async SaveDocEmployee() {
    this.$store.state.Loader.loading = true
    const formData = new FormData()
    formData.append('name', this.newDocPersonal.name)
    formData.append('type', this.newDocPersonal.type)
    formData.append('employe_id', this.employee.id)
    if (this.newDocPersonal.anexo !== null && typeof(this.newDocPersonal.anexo) !== 'string' ) {
          formData.append('anexo', this.newDocPersonal.anexo)
      }
    await axios.post(`${BASE_URL}employe/documento`, formData)
    this.getMe()
    this.dialogPersonalDocs = false
    this.$store.state.Loader.loading = false
    Swal.fire({
        icon: 'success',
        title: 'Dados guardados com sucesso',
        showConfirmButton: false,
        timer: 1500
    })
      
  },
  async SaveDocEdu() {
    this.$store.state.Loader.loading = true
    const formData = new FormData()
    formData.append('name', this.newDocEduc.name)
    formData.append('type', this.newDocEduc.type)
    formData.append('employe_id', this.employee.id)
    if (this.newDocEduc.anexo !== null && typeof(this.newDocEduc.anexo) !== 'string' ) {
          formData.append('anexo', this.newDocEduc.anexo)
      }
    await axios.post(`${BASE_URL}employe/documento`, formData)
    this.getMe()
    this.dialogEducationDocs = false
    this.$store.state.Loader.loading = false
    Swal.fire({
        icon: 'success',
        title: 'Dados guardados com sucesso',
        showConfirmButton: false,
        timer: 1500
    })
      
  }
  },
  watch: {
    user(user) {
      console.log(user);
    }
  },
  filters: {
    formatDate: (date) => {
		if (date) {
			let newDate = new Date(date);
			let newFormatedDate =
				newDate.getDate() +
				"/" +
				(newDate.getMonth() + 1) +
				"/" +
				newDate.getFullYear();
			return newFormatedDate;
		}
		return "";
	},
    getAge(date) {
        if (date) {
            var today = new Date();
            var birthDate = new Date(date);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }
        return "";
    }
  }
  
  

};
</script>
<style scoped>
.fileajjust {
    margin: auto;
    width: 120px;
    border: 2px solid rgba(128, 128, 128, 0.452);
    padding: 10px;
}
</style>
