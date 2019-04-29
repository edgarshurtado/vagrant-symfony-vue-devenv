<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      fixed
      app
    >
      <v-list dense>
        <template v-for="item in navBarMenuItems">
          <v-layout
            v-if="item.heading"
            :key="item.heading"
            row
            align-center
          >
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>
            <v-flex xs6 class="text-xs-center">
              <a href="#!" class="body-2 black--text">EDIT</a>
            </v-flex>
          </v-layout>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ item.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile
              v-for="(child, i) in item.children"
              :key="i"
              @click=""
            >
              <v-list-tile-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ child.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else :key="item.text" @click="">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="blue darken-3"
      dark
      app
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down">{{ i18n.pageName }}</span>
      </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        hide-details
        prepend-inner-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-menu bottom left>
        <v-btn icon slot='activator'>
            <v-icon>apps</v-icon>
        </v-btn>
        <v-list>
            <v-list-tile
              v-for="(item, key) in userMenuItems"
              :key="key"
             >
                <v-list-tile-title>{{ item }}</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
              <a href="/logout">Cerrar Sesión</a>
            </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
            <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer
        dark
        height="auto"
        app
    >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="blue darken-3">
        <strong class="subheading">{{ i18n.contactWithUs }}</strong>

        <v-spacer></v-spacer>

        <v-btn
          v-for="icon in socialIcons"
          :key="icon"
          class="mx-3"
          dark
          icon
        >
         <i :style="{'fontSize':'24px'}" :class="icon"></i>
        </v-btn>
      </v-card-title>

      <v-card-actions class="grey darken-3 justify-center">
        &copy;2019 — <strong>{{ i18n.pageName }}</strong>
      </v-card-actions>
    </v-card>
  </v-footer>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      drawer: null,
      navBarMenuItems: [
        { icon: 'search', text: 'Buscador de Escape Rooms' },
        { icon: 'stars', text: 'Las + Populares' },
        { icon: 'filter_list', text: 'Rankings' },
        { icon: 'fas fa-globe-europe', text: 'Estadísticas globales' },
        { icon: 'add', text: 'Añade una Escape Room' },
        { icon: 'fas fa-blog', text: 'Blog' },
        { icon: 'far fa-handshake', text: 'Colabora con Nosotros' },
        { icon: 'far fa-envelope', text: 'Contáctanos' }
      ],
      userMenuItems: [
        'Perfil',
        'Amigos',
        'Mis estadísticas',
        'Listas'
      ],
      socialIcons: [
          "fab fa-twitter", 
          "fab fa-facebook", 
          "fab fa-instagram"
      ],
      i18n:{
        contactWithUs: '¡Contacta con nosotros en las redes sociales!',
        pageName: 'Escapeaffinity'
      }
    })
  }
</script>