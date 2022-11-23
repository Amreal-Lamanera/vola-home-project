<template>
    <header>
        <nav>
            <div class="flex justify-between items-center">
                <ul class="flex items-center justify-end w-full">
                    <li>
                        <a href="./">
                            Home
                        </a>
                    </li>
                    <li v-for="link, i in navLinks" :key="i">
                        <router-link :to="{ name: link.name }">
                            {{ link.text }}
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    data() {
        return {
            navLinks: [
                {
                    text: 'Films',
                    path: '/films',
                    name: 'films',
                },
            ]
        }
    },
}
</script>

<style lang="scss" scoped>

nav {
    padding: 1rem 2rem;
    ul {
        gap: 2rem;
        
        a {
            color: #FFF;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            
            &:hover {
                text-decoration: underline;
            }
        }
    }
}

</style>