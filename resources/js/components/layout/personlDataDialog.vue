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
                ></v-text-field>
              </v-col>

            </v-row>
            <v-row>
                <v-col cols="12" md="4">
                    <v-text-field
                        label="Data de Nascimento"
                        outlined
                        dense
                        required
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-select
                    outlined
                    dense
                    :items="generos"
                    label="Género">
                </v-select>
            </v-col>
            <v-col cols="12" md="4">
                <v-select
                    outlined
                    dense
                    :items="estadoCivil"
                    label="Estado Civíl">
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
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Distrito"
                    outlined
                    dense
                    required
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Cidade / Localidade"
                    outlined
                    dense
                    required
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
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Celular Alternativo"
                    placeholder="8X1234567"
                    outlined
                    dense
                    required
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                    label="Cel / Tel"
                    placeholder="2X123456"
                    outlined
                    dense
                    required
                    ></v-text-field>
                </v-col>
            </v-row>
          </v-container>
          <small>* Indica que o campo é o obrigatorio</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="closeDialog()"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
</template>

<script>
export default {
    data() {
        return {
            tipoDocumentos:[
                "Bilhete de Identidade",
                "Carta de Condução"
            ],
            generos: [
                "F",
                "M"
            ],
            estadoCivil: [
                "Solteiro(A)",
                "Casado(A)",
                "Divorciado(A)",
                "Viúvo(A)",
            ]
        }
    },
    methods: {
        closeDialog() {
            this.$emit('closeDialog')
        }
    }
}
</script>

<style>

</style>
