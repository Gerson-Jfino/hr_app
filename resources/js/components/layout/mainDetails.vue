<template>
  <v-app id="inspire">
    <v-main class="grey lighten-3">
      <v-container>
        <v-row>
          <v-col cols="3">
            <v-sheet rounded="lg">
              <v-card>
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
                        <span style="color: aliceblue">GM</span>
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
            </v-sheet>
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
                            <strong>Data inicio</strong> &#x2022; {{ employee.data_admissao }} -
                            <strong>Data inicio</strong> &#x2022; {{ employee.data_fim }}
                          </div>
                          <div>
                            <strong>{{ employee?.situation?.name }}</strong> &#x2022; {{ employee.data_situacao }}
                          </div>
                          <div>
                            <strong>SALARIO: </strong> {{ employee.salario }}
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
        salario: ""
    },
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
            // console.log(this.employee);
            this.$store.state.Loader.loading = false
        } catch (error) {
            console.log(error);
            this.$router.push({name: 'login'})
        }
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
  },

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
