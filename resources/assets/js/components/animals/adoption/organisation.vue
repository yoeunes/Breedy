<template>
	<div class="">
        <div class="btn-view__container-title">
            <h2 role="heading" aria-level="2" class="animal-title">Organisation(s)</h2>
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
            <span class="animal__label">Livre des origines français</span>
            <span class="animal__input">LOF 1 BB 00/001/0001</span>
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
