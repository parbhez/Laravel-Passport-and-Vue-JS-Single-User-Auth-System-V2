<template>
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Data Segregation List</h5>
                    </div>
                    <div class="col-md-6 text-ri text-right">
                        <button
                            :data-bs-target="'#'+ modal_name"
                            data-bs-toggle="modal"
                            class="btn btn-primary mb-3 text-nowrap add-new-role"
                            @click.prevent="beforeOpen"
                        >
                            Add New Category
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <overlay-preloader :action="preload"></overlay-preloader>
                    <div class="px-2 py-1 mt-0">
                        <v-table-head :meta="meta" @changed="pageChange" @search="applySearch"></v-table-head>
                    </div>

                <div class="dt-row-grouping table table-bordered" :class="preload ? 'loader-secondary' : ''">
                    <v-simple-table
                            :headers="[
                                '#SL.',
                                'Category Name',
                                'Status',
                                'Actions',
                            ]"
                        >
                            <tr
                                v-for="(category, key) in categoryList"
                                :key="key"
                            >
                                <td>
                                     {{meta.per_page * (meta.current_page-1) + (key+1) }}
                                </td>
                                <td>
                                    <span> {{ category.category_name }} </span>
                                </td>
                                
                                
                                <td>
                                    <select class="form-control" @change="changeStatus(category, $event)">
                                        <option :selected="status.value == category.status" v-for="(status,key) in statuses" :key="key" :value="status.value">{{ status.name }}</option>
                                    </select>
                                </td>

                                <td class="align-middle">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm mr-2"
                                        @click.prevent="onClickHandleAction('edit', category)"
                                    >
                                        Edit
                                    </button>
                                    
                                </td>
                            </tr>
                        </v-simple-table>
                        <not-found class="py-5" v-if="categoryList.length == 0" :message="loading ? 'Loading...' : 'Oops..! No data available in the system.'"></not-found>
                </div>

                <div class="p-2 mt-3">
                            <v-paginate v-if="categoryList.length > 0" :offset="5" :meta="meta" @changed="pageChange"></v-paginate>
                    </div>
            </div>
        </div>


        <!-- Add Role Modal -->
        <div
            class="modal fade"
            :id="modal_name"
            tabindex="-1"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-md modal-dialog-centered modal-add-new-role"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center mb-4">
                            <h5 class="role-title">{{modal_title}} Category</h5>
                        </div>
                        <button
                            type="button"
                            class="btn-close btn-pinned"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add role form -->
                        <form
                            class="row g-3"
                           
                        >
                            <BaseInput
                                    v-model="form.category_name"
                                    label="Category Name"
                                    type="text"
                                    placeholder="Enter Category Name"
                            ></BaseInput>

                            <BaseTextarea
                                    v-model="form.remarks"
                                    label="Remarks"
                                    type="text"
                                    placeholder="Enter Remarks"
                            ></BaseTextarea>

                        </form>
                        <!--/ Add role form -->
                    </div>
                    <div class="modal-footer border-top pt-2">
                        <button
                            type="button"
                            class="btn btn-success btn-sm me-sm-3 me-1"
                            :class="isLoading(loading)"
                            :disabled="loading"
                            @click.prevent="onSubmitForm"
                        >
                        {{button_name}}
                        </button>
                        <button
                            type="reset"
                            class="btn btn-label-secondary btn-sm btn-danger"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->
    </div>
    <!--/ Content -->
</template>

<script>
import { Categories } from '../../../../core/endpoints'
export default {
    data() {
        return {
            modal_name: 'category-modal',
            modal_title: '',
            button_name: '',
            fetchable: "fetchCategoryList",
            filterable: "filters",
            categoryList: [],
            preload: false,
            meta: {},
            loading: false,
            preload: false,
			id: null,
            form: this.initForm(),
            statuses:[
                {
                    name: 'Active',
                    value: 1
                },
                {
                    name: 'Inactive',
                    value: 0
                },
            ],
        };
    },

    mounted() {
        this.fetchCategoryList();
    },

    computed: {

    },

    watch:{

    },

    methods: {

        beforeOpen() {
            this.modal_title = "Add";
            this.button_name = "Save";
		    this.form = this.initForm();
		},

        changeStatus(category, event) {
			if(category) {
				this._initForm(category);
				this.form.status = parseInt(event.target.value)
                //return console.log(this.form);
				this.onSubmitForm()
			}
		},

        async onSubmitForm() {
    
			try {
				this.loading = true
				this.preload = true
				let formId = this.id;
				let { data } = await axios[!this.id ? 'post' : 'put'](!this.id ? `${Categories}` : `${Categories}/${formId}`, this.form);
               // console.log(data.data)
				this.updateState(data.data, 'categoryList', this.id);
                $("#"+this.modal_name).modal("hide");
                this.success(`${this.id ? data.message : data.message}`);
				this.loading = false
				this.preload = false
			} catch(error) {
                //console.log(error);
                $("#"+this.modal_name).modal("hide");
                  this.setFormErrors(error);
                  this.error('Failed to create school!');
				  this.loading = false
				  this.preload = false
			}
		},

        async fetchCategoryList() {
            this.preload = true;
           let { data } = await axios.get(`${Categories}/${this.getURLQueryString()}`);
            //return console.log(data);
            this.categoryList = data.data;
            this.meta = data.meta;
           // console.log(this.meta);
            this.preload = false;
        },

        initForm() {
            return {
                category_name: null,
                remarks: null,
                status: 1,
            };
        },
    },
};
</script>