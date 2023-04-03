<template>
    <div
        class="d-flex flex-column flex-lg-row justify-content-between align-items-center"
    >
        <div class="dataTables_info">
            Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} entries
        </div>

        <nav>
            <ul class="pagination mb-0">
                <li
                    class="page-item"
                    :class="{ disabled: meta.current_page == 1 }"
                >
                    <a href="#" class="page-link" @click.prevent="broadcast(1)" style="cursor:pointer;">
                        First page
                    </a>
                </li>

                <li
                    class="paginate_button page-item previous"
                    :class="{ disabled: meta.current_page == 1 }"
                >
                    <a
                        href="#"
                        class="page-link"
                        @click.prevent="broadcast(meta.current_page - 1)"
                        style="cursor:pointer;"
                    >
                    Previous
                    </a>
                </li>

                <li
                    v-for="(page, key) in pages"
                    :key="key"
                    class="paginate_button page-item"
                    :class="{ active: meta.current_page == page }"
                >
                    <a
                        href="#"
                        class="page-link"
                        @click.prevent="broadcast(page)"
                        >{{ page }}</a
                    >
                </li>

                <li
                    class="paginate_button page-item next"
                    :class="{ disabled: meta.current_page == meta.last_page }"
                >
                    <a
                        href="#"
                        class="page-link"
                        style="cursor:pointer;"
                        @click.prevent="broadcast(meta.current_page + 1)"
                    >
                    Next
                    </a>
                </li>

                <li
                    class="page-item"
                    :class="{ disabled: meta.current_page == meta.last_page }"
                >
                    <a
                        href="#"
                        class="page-link"
                        style="cursor:pointer;"
                        @click.prevent="broadcast(meta.last_page)"
                    >
                    Last page
                    </a>
                </li>
            </ul>
        </nav>

        <div>
            <label>
                Show
                <select
                    class="select-page-limit"
                    style="color: white"
                    v-model="limit"
                    @change="handleOnChangePerPageLimit"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="500">500</option>
                </select>
                entries
            </label>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
export default {
    props: {
        meta: Object,
        offset: Number,
    },

    watch: {
        meta() {
            this.limit = this.meta.per_page;
        },
    },

    mounted(){

    },

    data() {
        return {
            page: 1,
            limit: 10,
        };
    },

    computed: {
        pages() {
            let pages = []
            let from = this.meta.current_page - Math.floor(this.offset / 2)
            if (from < 1) {
                from = 1
            }
            let to = from + this.offset -1
            if (to > this.meta.last_page) {
                to = this.meta.last_page
            }
            while (from <= to) {
                pages.push(from)
                from++
            }
            return pages
        },

        gotoPage() {
            const gotoData = [];
            for (let i = 2; i <= this.meta.last_page; i++) {
                gotoData.push(i);
            }
            return gotoData;
        },
    },

    methods: {

        broadcast(page, limit = this.limit) {
            this.$emit("changed", { page, limit });
        },

        handleOnChangePerPageLimit() {
            let totalPage = Math.round(this.meta.total / this.limit);
            if (totalPage < this.page) {
                this.broadcast(totalPage, this.limit);
                return;
            }
            if (totalPage > 0) {
                this.broadcast(this.page, this.limit);
            }
        },
    },
};
</script>

<style scoped>
.select-page-limit {
    width: 80px;
    height: 30px !important;
    padding: 0px 10px !important;
    border: 1px solid #aaa;
    border-radius: 3px;
    background-color: #484a56;
}
</style>
