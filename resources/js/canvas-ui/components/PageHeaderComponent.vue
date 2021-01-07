<template>
    <div class="border-bottom">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12">
            <nav class="navbar d-flex px-0 py-1">
                <router-link :to="{ name: 'posts' }" class="navbar-brand hover font-weight-bolder mr-3">
                    UKM Musik ITS
                </router-link>
                <div class="mr-auto border-left pl-1">
                    <router-link :to="{ name: 'tags' }" class="btn btn-link py-0 text-decoration-none">
                        Kategori
                    </router-link>
                    <router-link :to="{ name: 'topics' }" class="btn btn-link py-0 text-decoration-none">
                        Topik
                    </router-link>
                </div>

                <slot v-if="user" name="options" />

                <div v-if="user" class="dropdown ml-3">
                    <a
                        id="navbarDropdown"
                        href="#"
                        class="nav-link px-0 text-secondary"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <img
                            :src="user.avatar || user.default_avatar"
                            :alt="user.name"
                            class="rounded-circle my-0 shadow-inner"
                            style="width: 33px"
                        />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header">
                            <strong>{{ user.name }}</strong>
                            <br />
                            {{ user.email }}
                        </h6>
                        <div class="dropdown-divider" />
                        <a :href="`/${canvasPath}/users/${user.id}/edit`" class="dropdown-item">Profil Anda</a>
                        <a :href="`/${canvasPath}/posts`" class="dropdown-item">Tulisan</a>
                        <a v-if="isAdmin" :href="`/${canvasPath}/users`" class="dropdown-item">Users</a>
                        <a v-if="isAdmin" :href="`/${canvasPath}/tags`" class="dropdown-item">Kategori</a>
                        <a v-if="isAdmin" :href="`/${canvasPath}/topics`" class="dropdown-item">Topik</a>
                        <a :href="`/${canvasPath}/stats`" class="dropdown-item">Statistik</a>
                        <div class="dropdown-divider" />
                        <a :href="`/${canvasPath}/settings`" class="dropdown-item">Pengaturan</a>
                        <a href="" class="dropdown-item" @click.prevent="logout"> Sign out </a>
                    </div>
                </div>

                <!-- <a v-if="!user" :href="`/${canvasPath}/login`" class="btn btn-link text-decoration-none">Sign in</a> -->
            </nav>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'page-header-component',

    data() {
        return {
            user: CanvasUI.user, // eslint-disable-line no-undef
            canvasPath: CanvasUI.canvasPath, // eslint-disable-line no-undef
        };
    },

    methods: {
        logout() {
            axios.get(`/${this.canvasPath}/logout`).then(() => {
                window.location.href = `/${this.canvasPath}/login`;
            });
        },
    },
};
</script>
