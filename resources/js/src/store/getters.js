const getters = {

	// COMPONENT
		// vx-autosuggest
	// starredPages: state => state.navbarSearchAndPinList.data.filter((page) => page.highlightAction),

    isAuthenticated: state => !!state.accessToken,
    authStatus: state => state.status,
}

export default getters
