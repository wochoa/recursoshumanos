export const menuItems = [
    {
        id: 1,
        label: "menuitems.menu.text",
        isTitle: true
    },
    {
        id: 2,
        label: "Dashboard",
        icon: "bx-home-circle",
        link:"/"
        // subItems: [
        //     {
        //         id: 3,
        //         label: "menuitems.dashboards.list.default",
        //         link: "/",
        //         parentId: 2
        //     },
        // ]
    },
    {
        id: 3,
        isLayout: true
    },

    {
        id: 4,
        label: "Gestión de usuarios",//menuitems.pages.text
        isTitle: true
    },
    {
        id: 5,
        label: "Gestión de usuarios",
        icon: "bxs-notepad",
        subItems: [
            {
                id: 6,
                label: "Lista de usuarios",
                link: "/usuarios/lista",
                parentId: 5
            },
            {
                id: 7,
                label: "Control de asistencias",
                link: "/usuarios/asistencias",
                parentId: 5
            },
            {
                id: 8,
                label: "Movimiento de usuarios",
                link: "/usuarios/movimiento",
                parentId: 5
            },
            {
                id: 9,
                label: "Permisos y licencias",
                link: "/usuarios/permisolicencia",
                parentId: 5
            },
            {
                id: 10,
                label: "Gestion de vacaciones",
                link: "/usuarios/vacaciones",
                parentId: 5
            },
            {
                id: 11,
                label: "Gestion de honomástico",
                link: "/usuarios/honomastico",
                parentId: 5
            },

            {
                id: 12,
                label: "Boletas de pago",
                link: "/usuarios/boletaspago",
                parentId: 5
            },
            {
                id: 12,
                label: "Certificados de trabajo",
                link: "/usuarios/certificados",
                parentId: 5
            }
        ]
    },
    // {
    //     id: 10,
    //     label: "Catálogo de  archivadores",
    //     icon: "bx-fridge",
    //     link:"/"

    // },
    // {
    //     id: 13,
    //     label: "Legajo personal",
    //     icon: "bx-terminal",
    //     subItems: [
    //         {
    //             id: 14,
    //             label: "Legajo personal",
    //             link: "/auth/login-1",
    //             parentId: 13
    //         },
    //         {
    //             id: 15,
    //             label: "Mesa partes virtual",
    //             link: "/auth/login-2",
    //             parentId: 13
    //         }
    //     ]
    // },


    // {
    //     id: 16,
    //     label: "Proyectos",
    //     isTitle: true
    // },
    // {
    //     id: 50,
    //     label: "Gestion de patrimonial",
    //     icon: "bx-share-alt",
    //     subItems: [
    //         {
    //             id: 51,
    //             label: "menuitems.multilevel.list.level1.1",
    //             link: "#",
    //             parentId: 50
    //         },

    //     ]
    // },
    {
        id: 16,
        label: "Administración",
        isTitle: true
    },
    {
        id: 17,
        label: "Administración sistema",
        icon: "bx-cog",
        subItems: [
            {
                id: 18,
                label: "Entidades externas",
                link: "#",
                parentId: 17
            },

            {
                id: 27,
                label: "Roles y permisos",
                link: "#",
                parentId: 17
            },

        ]
    },
];
