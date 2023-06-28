<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col-3">
                <label>Source</label>
                <input type="text" class="form-control" @keyup.enter="getFlights" v-model="source"/>
            </div>
            <div class="col-3">
                <label>Start</label>
                <input type="date" class="form-control" @keyup.enter="getFlights" v-model="start"/>
            </div>
            <div class="col-3">
                <label>End</label>
                <input type="date" class="form-control" @keyup.enter="getFlights" v-model="end"/>
            </div>
            <div class="ms-4 pt-3 col-2">
                <button class="btn btn-lg btn-primary" @click="getFlights">Filter</button>
            </div>
        </div>
        <div class="row table-responsive">
            <table class="table">
                <thead>
                    <th>
                        Airline
                    </th>
                    <th>
                        Aircraft
                    </th>
                    <th>
                        Source
                    </th>
                    <th>
                        Destination
                    </th>
                    <th>
                        Take Off
                    </th>
                </thead>
                <tbody v-if="flights.length">
                    <template v-for="(flight, key) in flights">
                        <tr :class="(flight.is_cancelled ? 'pe-none table-danger ' : '') + (rowsActive[key] ? 'table-active' : '')" @click="rowsActive[key] = !rowsActive[key]">
                            <td>
                                {{ flight.airline.name }}
                            </td>
                            <td>
                                {{ flight.aircraft.name }}
                            </td>
                            <td>
                                {{ flight.source }}
                            </td>
                            <td>
                                {{ flight.destination }}
                            </td>
                            <td>
                                {{ formatDate(flight.take_off) }}
                            </td>
                        </tr>
                        <tr class="child" v-if="rowsActive[key]">
                            <td colspan="5">
                                <table class="table">
                                    <tr class="">
                                        <td colspan="5" class="d-flex flex-row justify-content-evenly">
                                            <div :class="'d-flex flex-row fs-6 text text-' + (flight.availableTickets ? 'success' : 'danger')">
                                                <i class="me-2 bi bi-ticket-detailed"></i>
                                                <p>{{ flight.availableTickets ? 'Available tickets: ' + flight.availableTickets : 'No available tickets' }}</p>
                                            </div>
                                            <div v-if="flight.availableTickets">
                                                <div class="form-check form-check-inline">
                                                    <input v-model="flight.ticketType" class="form-check-input" type="radio" :name="'radio' + flight.id" :id="'economy' + flight.id" value="Economy">
                                                    <label class="form-check-label" :for="'economy' + flight.id">Economy</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="flight.ticketType" class="form-check-input" type="radio" :name="'radio' + flight.id" :id="'business' + flight.id" value="Business">
                                                    <label class="form-check-label" :for="'business' + flight.id">Business</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="flight.ticketType" class="form-check-input" type="radio" :name="'radio' + flight.id" :id="'first-class' + flight.id" value="First-class">
                                                    <label class="form-check-label" :for="'first-class' + flight.id">First-class</label>
                                                </div>
                                            </div>
                                            <div v-if="flight.availableTickets">
                                                <button class="btn btn-sm btn-primary" @click="purchaseTicket(flight.id, flight.ticketType, key)">Purchase</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <nav v-if="flights.length" class="mt-2">
                <ul class="pagination justify-content-center">
                    <li :class="'page-item' + (this.page === 1 ? ' disabled' : '')">
                        <a class="page-link" @click="page--">Previous</a>
                    </li>
                    <li v-for="i in numberOfPages" :class="'page-item' + (page === i ? ' active' : '')"><a class="page-link" @click="setPage(i)">{{ i }}</a></li>
                    <li :class="'page-item' + (this.page === this.numberOfPages ? ' disabled' : '')">
                        <a class="page-link" @click="page++">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return {
            flights: [],
            source: '',
            start: '',
            end: '',
            numberOfPages: 0,
            page: 1,
            rowsActive: [],
            showLoader: false,
        }
    },
    methods: {
        init(){
            this.showLoader = true;
            this.getFlights();
        },
        getFlights(){
            axios
                .get(`/api/flights?source=${this.source}&start=${this.start}&end=${this.end}&page=${this.page}`)
                .then(({data}) => {
                    this.flights = data.list;
                    this.numberOfPages = data.numberOfPages;
                })
                .catch((error) => {
                    //this.showAlert(error);
                })
                .finally(() => {
                    this.showLoader = false;
                });
        },
        setPage(page){
            if(this.page === page)
                return;

            this.page = page;
            this.getFlights();
        },
        formatDate(dateTime){
            return new Date(dateTime).toLocaleString();
        },
        purchaseTicket(flightId, type, key){
            this.showLoader = true;
            axios
                .post(
                    '/api/sold-tickets',
                    {
                        flight_id: flightId,
                        type: type,
                    }
                )
                .then(({data}) => {
                    this.flights[key] = Object.assign(this.flights[key], data);
                })
        }
    },
    mounted(){
        this.init();
    }
}
</script>

