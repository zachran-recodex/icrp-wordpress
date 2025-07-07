import Alpine from 'alpinejs'

// Start Alpine
window.Alpine = Alpine
Alpine.start()

// Navigation component
Alpine.data('navigation', () => ({
    open: false,
    toggle() {
        this.open = !this.open
    },
    close() {
        this.open = false
    }
}))

// Search component
Alpine.data('search', () => ({
    open: false,
    query: '',
    toggle() {
        this.open = !this.open
        if (this.open) {
            this.$nextTick(() => this.$refs.searchInput.focus())
        }
    },
    close() {
        this.open = false
        this.query = ''
    },
    submit() {
        if (this.query.trim()) {
            window.location.href = `${window.location.origin}/?s=${encodeURIComponent(this.query)}`
        }
    }
}))

// Modal component
Alpine.data('modal', () => ({
    open: false,
    show() {
        this.open = true
        document.body.style.overflow = 'hidden'
    },
    hide() {
        this.open = false
        document.body.style.overflow = ''
    }
}))

// Accordion component
Alpine.data('accordion', () => ({
    open: false,
    toggle() {
        this.open = !this.open
    }
}))

// Tabs component
Alpine.data('tabs', (defaultTab = 0) => ({
    activeTab: defaultTab,
    setTab(index) {
        this.activeTab = index
    }
}))

// Scroll to top component
Alpine.data('scrollToTop', () => ({
    show: false,
    init() {
        window.addEventListener('scroll', () => {
            this.show = window.scrollY > 300
        })
    },
    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    }
}))

// Back to top on page load
window.addEventListener('load', function () {
    window.scrollTo(0, 0)
})
