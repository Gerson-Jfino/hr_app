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
                            <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12" style="margin-top: 20px;">
                                <v-avatar
                                class="profile avatar-center-heigth avatar-shadow" color="grey" size="60">
                                    <span style="color: aliceblue;">GM</span>
                                </v-avatar>
                            </v-col>
                            <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12">
                                <div class="grey--text ms-1">001212</div>
                            </v-col>
                            <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12" style="margin-top: -20px;">
                                <v-card-title><strong> Gerson Maoze</strong></v-card-title>
                            </v-col>
                            <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12" style="margin-top: -20px;">
                                <div class="grey--text ms-4" style="font-size: small;">Direção de Tecnlogia de Informatica</div>
                            </v-col>
                            <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12" style="margin-top: -20px;">
                                <div class="" style="font-size: small;">Pelouro de De destribuição Comercial e Informatica</div>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-divider class="mx-4"></v-divider>

                    <v-card-text>
                        <v-row>
                            <v-card-title>
                                Informação pessoal
                            </v-card-title>
                            <v-btn  class="ma-4"
                                outlined
                                color="indigo"
                                small>
                                <v-icon>mdi-pencil</v-icon>
                                Editar
                            </v-btn>
                        </v-row>
                    <v-row
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
                    </v-row>

                    <div class="my-4 text-subtitle-1">
                        $ • Italian, Cafe
                    </div>

                    <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
                    </v-card-text>

                    <v-divider class="mx-4"></v-divider>

                    <v-card-title>Tonight's availability</v-card-title>

                    <v-card-text>
                    <v-chip-group
                        v-model="selection"
                        active-class="deep-purple accent-4 white--text"
                        column
                    >
                        <v-chip>5:30PM</v-chip>

                        <v-chip>7:30PM</v-chip>

                        <v-chip>8:00PM</v-chip>

                        <v-chip>9:00PM</v-chip>
                    </v-chip-group>
                    </v-card-text>

                </v-card>
              </v-sheet>
            </v-col>

            <v-col>
              <v-sheet
                min-height="70vh"
                rounded="lg"
              >
                <!--  -->
              </v-sheet>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
  </template>

  <script>
    export default {
      data: () => ({
        links: [
          'Dashboard',
          'Messages',
          'Profile',
          'Updates',
        ],
      }),
    }
  </script>
