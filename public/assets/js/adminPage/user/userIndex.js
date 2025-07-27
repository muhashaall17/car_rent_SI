// DATATABLE USER START
let dtbDriver = new DataTable("#User", {
    processing: true,
    serverSide: false,
    ajax: getUser,
    columns: [
        {
            data: null, // tidak mengambil dari field data
            class: "text-start",
            orderable: true,
            searchable: false,
            render: (data, type, row, meta) => {
                return meta.row + 1;
            },
        },
        {
            data: "name",
            class: "text-start",
            name: "nama_pengguna",
        },
        {
            data: "username",
            class: "text-start",
            name: "username",
        },
        {
            data: "role",
            class: "text-start",
            name: "role",
            render: (data, type, row) => {
                if (data == "super_admin") {
                    return "Owner";
                } else {
                    return "Admin";
                }
            },
        },
        {
            data: "email",
            class: "text-start",
            name: "email",
        },
        {
            data: "id",
            orderable: false,
            class: "text-center",
            render: (data, type, row) => {
                if (data == 3) {
                    return "-";
                } else {
                    return `<a style="font-size: 16px" href="#" class="btn btn-sm btn-primary edit-user-btn" data-key="${data}" data-name="${row["name"]}"  data-username="${row["username"]}" data-role="${row["role"]}" data-email="${row["email"]}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a style="font-size: 16px" href="#" class="btn btn-sm btn-danger delete-user-btn" data-key="${data}">
                        <i class="fa fa-trash"></i>
                    </a>`;
                }
            },
        },
    ],
});
// DATATABLE USER END
