<template>
	<div class="">
        <div class="btn-view__container-title">
            <h2 role="heading" aria-level="2" class="animal-title">Dépenses</h2>
            <el-dropdown>
				<button class="btn-view-more">
					<i class="el-icon-more"></i>
				</button>
				<el-dropdown-menu slot="dropdown">
					<el-dropdown-item>Modifier</el-dropdown-item>
				</el-dropdown-menu>
			</el-dropdown>
        </div>
        <div>
            <span>&euro; 178,88</span>
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
