<template>
     <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Cards with few info -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">7</h5>
                                                    <small class="text-muted">Collected</small>
                                                </div>
                                            </div>
                                            <div id="conversationChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">3</h5>
                                                    <small class="text-muted">Duplicate</small>
                                                </div>
                                            </div>
                                            <div id="incomeChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">1</h5>
                                                    <small class="text-muted">Fake</small>
                                                </div>
                                            </div>
                                            <div id="profitChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2 text-center">3</h5>
                                                    <small class="text-muted">Ready</small>
                                                </div>
                                            </div>
                                            <div id="expensesLineChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Cards with few info -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6 text-ri text-right">
                                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap add-new-role ">
                                            Add New
                                        </button>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body table-responsive">
                                <table class="dt-row-grouping table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 50px">SL</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Description</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Business</td>
                                            <td>Tk 5,000 crore scheme launched for capital machinery purchase</td>
                                            <td>Bangladesh Bank today rolled out a Tk 5,000 crore refinance scheme to help borrowers procure environment-friendly capital machinery. The scheme named "Green transformation fund" will help borrowers to replace
                                                their existing capital machinery, which are harmful for environment. Businesses will be allowed to get fund to replace their capital machinery in nine categories. The nine fields include water use efficiency
                                                in wet processing, water conservation and management, resource efficiency and recycling, renewable energy and heat and temperature management, according to a central bank notice.</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Business</td>
                                            <td>Bangladesh demands restoration of US GSP during Ticfa talks </td>
                                            <td>Bangladesh has demanded the United States restore the generalised system of preferences (GSP) status during the 6th round meeting of the Trade and Investment Cooperation Forum Agreement (Ticfa) in Washington
                                                on Tuesday. Both Dhaka and Washington affirmed the importance of Bangladesh's efforts aimed at reforming its labour laws and discussed Bangladesh's interest in the restoration of its beneficiary status under
                                                the US GSP programme, according to a statement from the United States Trade Representative (USTR), the chief trade negotiation body of the North American country.</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Sports</td>
                                            <td>Mehedi breaks the 107-run stand with Shreyas' wicket</td>
                                            <td>All-rounder Mehidi Hasan Miraz managed to pick up the all-important wicket of Shreyas Iyer as the batter was held out at deep mid-wicket trying to go over the boundary in the second ODI of the three-match series
                                                at the Sher-e-Bangla National Cricket Stadium on Wednesday. Shreyas smashed three sixes and six fours to score 82 while stitching up a 107-run partnership with Axar Patel who also reached his fifty. Bangladesh
                                                off-spinner Mehidi Hasan Miraz trapped KL Rahul lbw for 14 runs to reduce India to 80-4 in pursuit of Bangladesh's 271 after the end of 20 overs in the second ODI of the three-match series at the Sher-e-Bangla
                                                National Cricket Stadium on Wednesday.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- Add Role Modal -->
                        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                <div class="modal-content">
                                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-body">
                                        <div class="text-center mb-4">
                                            <h3 class="role-title">Add New </h3>

                                        </div>
                                        <!-- Add role form -->
                                        <form id="addRoleForm" class="row g-3" onsubmit="return false">

                                            <div class="col-12">
                                                <label class="form-label" for="modalRoleName">Category</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Select Category</option>
                                                    <option value="1">Business</option>
                                                    <option value="2">Sports</option>
                                                    <option value="3">politics</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="modalRoleName">Title</label>
                                                <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Title" tabindex="-1" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="modalRoleName">Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>


                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                        <!--/ Add role form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Add Role Modal -->



                    </div>
</template>

<script>

</script>

<style scoped>
button.dt-button.buttons-collection.btn.btn-label-primary.dropdown-toggle.me-2 {
            display: none;
        }

        .source-btn {
            display: none;
        }

</style>
