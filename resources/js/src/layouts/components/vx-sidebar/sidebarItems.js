/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  Strucutre:
          url     => router path
          name    => name to display in sidebar
          slug    => router path name
          icon    => Feather Icon component/icon name
          tag     => text to display on badge
          tagColor  => class to apply on badge element
          i18n    => Internationalization
          submenu   => submenu of current item (current item will become dropdown )
                NOTE: Submenu don't have any icon(you can add icon if u want to display)
          isDisabled  => disable sidebar item/group
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default [
    {
        url: "/",
        name: "Tableau de bord",
        slug: "dashboard",
        icon: "HomeIcon",
    },
    {
        url: null,
        name: "Projets de cosplay",
        slug: 'projects',
        icon: 'FolderIcon',
        sidebarGrp: 'projects',
        submenu: [
            {
                url: "/projects",
                name: "Mes projets",
                slug: 'projects',
                icon: 'FolderIcon'
            },
            {
                url: "/projects/new",
                name: "Nouveau projet",
                slug: 'new-project',
                icon: 'CheckIcon'
            },
        ]
    },
    {
        url: "/page2",
        name: "Page 2",
        slug: "page2",
        icon: "FileIcon",
    },
]
