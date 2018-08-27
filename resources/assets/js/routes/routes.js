import Dashboard from '../views/Dashboard'
// Animals
import Adoption from '../views/animals/adoption/adoption_index';
import AdoptionView from '../views/animals/adoption/adoption_view';
import Breeding from '../views/animals/breeding/breeding_index';

export default [{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        props: { currentTeam: Spark.state.currentTeam }
    },

    // Animals Adoption
    {
        path: '/animals/adoption',
        name: 'adoption',
        component: Adoption,
        props: { currentTeam: Spark.state.currentTeam, teams: Spark.state.teams }
    },

    {
        path: '/animals/adoption/:id',
        component: AdoptionView,
        name: 'AdoptionView'
    },

    // Animals Breedings
    {
        path: '/animals/breeding',
        name: 'breeding',
        component: Breeding,
        props: { currentTeam: Spark.state.currentTeam }
    }
]