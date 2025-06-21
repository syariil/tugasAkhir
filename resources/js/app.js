import "./bootstrap";
import "flowbite";
import "../css/app.css";
import Alpine from "alpinejs";


// resources/js/app.js
const appUrl = document.querySelector('meta[name="app-url"]').content;


// Inisialisasi Alpine
window.Alpine = Alpine;

// Schedule Component
document.addEventListener('alpine:init', () => {
            Alpine.data('scheduleGet', () => ({
                activeTab: 'day1',
                loading: true,
                schedules: [],
                numberTab: 1,
                tabShow: false,

                init() {
                    this.fetchSchedules();
                    // this.tabShow = this.activeTab === this.numberTab;
                    // Watch for tab changes
                    this.$watch('activeTab', (newTab) => {
                        this.schedules = [];
                        this.loading = true;
                        this.fetchSchedules();
                    });
                },

                fetchSchedules() {
                    this.loading = true;
                    // get number from active tab
                    const dayNumber = this.activeTab.replace('day', '');
                    this.tabShow = this.activeTab === `day${dayNumber}`;

                    this.numberTab = dayNumber;
                    fetch(`${appUrl}/api/schedules/${dayNumber}`)
                        .then(response => response.json())
                        .then(data => {
                            this.schedules = data;
                            this.loading = false;
                        })
                        .catch(error => {
                            const path = "{{ env('APP_URL')}}";
                            console.log(path);
                            console.error('Error fetching schedules:', error);
                            this.loading = false;
                        });
                },


                filteredSchedules(day) {
                    return this.schedules.filter(item => item.day === day);
                },

                formatTime(time) {
                    const [hours, minutes] = time.split(`:`);

                    const date = new Date();
                    date.setHours(parseInt(hours));
                    date.setMinutes(parseInt(minutes));
                    date.setSeconds(0);

                    return date.toLocaleTimeString("id-ID", {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                formatDate(date) {
                    const dte = new Date(date);
                    return new Intl.DateTimeFormat('id-ID', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'long'
                    }).format(dte);
                },

                safeImagePath(path) {
                    return path ? `${appUrl}/storage/image/logo/${path.replace(/^\/+/, '')}` : `${appUrl}/storage/image/logo/logo.png`;           
                },
            }));
            Alpine.data('standingData', () => ({
                    activeTab: 3 ?? 0 , // Default to first grup id
                    loading: true,
                    standings: [],
                    tabShow: false,

                    init() {
                        // Load initial data
                        this.fetchStandings();
                    },

                    changeTab(grupId) {
                        this.activeTab = grupId;
                        this.tabShow = false;
                        this.loading = true;
                        this.standings = [];
                        this.fetchStandings();
                    },

                    fetchStandings() {
                        fetch(`${appUrl}/api/schedules/${this.activeTab}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                this.standings = data;
                                this.loading = false;
                                this.tabShow = true;
                            })
                            .catch(error => {
                                console.error('Error fetching standings:', error);
                                this.loading = false;
                                this.tabShow = true;
                                this.standings = [];
                            });
                    }

                }));
        });

// Start Alpine setelah semua komponen terdaftar
Alpine.start();

// Loader animation (tetap seperti sebelumnya)
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        setTimeout(() => {
            preloader.classList.add('hidden');
        }, 500);
    }
});

const loader = document.getElementById('page-loader');
if (loader) {
    window.addEventListener('load', function() {
        loader.classList.add('opacity-0');
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 500);
    });

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (loader) {
                loader.classList.remove('hidden', 'opacity-0');
                loader.classList.add('opacity-100');
                e.preventDefault();
                setTimeout(() => {
                    window.location.href = href;
                }, 100);
            }
        });
    });
}