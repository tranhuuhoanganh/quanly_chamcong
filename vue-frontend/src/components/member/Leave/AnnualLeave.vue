<template>
    <div>
        <div class="row g-3">

            <div class="col">
                <div class="card-stat">
                    <div class="title">Phép được cấp</div>
                    <div class="value text-success">12</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Đã sử dụng</div>
                    <div class="value text-success">5</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Còn lại</div>
                    <div class="value text-success">7</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Không lương</div>
                    <div class="value text-success">2</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Chờ duyệt</div>
                    <div class="value text-success">2</div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <!-- Table -->
            <div class="card border-0 shadow-sm overflow-hidden"
                style="border-radius:15px;border-top:3px solid #0f766e !important;">

                <div class="card-body p-0">

                    <table class="table align-middle mb-0">

                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="py-3 ps-4">STT</th>
                                <th class="py-3">Ngày giải trình</th>
                                <th class="py-3">Nghỉ từ ngày</th>
                                <th class="py-3">Nghỉ đến ngày</th>
                                <th class="py-3">Loại</th>
                                <th class="py-3">Trạng thái</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</template>

<style scoped>
.card-stat {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-top: 3px solid #0f766e;
}

.title {
    font-size: 0.8rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 8px;
}

.value {
    font-size: 1.8rem;
    line-height: 1;
    font-weight: 700;
}

.row>.col {
    flex: 0 0 20%;
    max-width: 20%;
}
</style>