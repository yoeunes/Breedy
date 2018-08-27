<template>
	<div class="">
        <div class="btn-view__container-title">
            <h2 role="heading" aria-level="2" class="animal-title">Statut</h2>
            <button class="btn-view-more">
                <img src="icons/right-arrow.svg" class="button-arrow">
            </button>
        </div>
        <div>
            <span class="animal-profile__status">Réservé</span>
            <span class="animal-profile__status-name">Par Alfred Till</span>
        </div>
	</div>
</template>

<script>
    export default {
        name: "infosAdoption",
        props: ['animal'],
        data(){
            return {
    
            }
        }
    }
</script>

<style scoped>

</style>
