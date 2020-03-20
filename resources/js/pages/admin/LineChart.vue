<script>
//Importing Line class from the vue-chartjs wrapper
import { Line } from 'vue-chartjs'

//Exporting this so it can be used in other components
export default {
extends: Line,
 props: {
    datacollection: {
      type: Object,
      default: null
    },
    options: {
      type: Object,
      default: null
    }
  },
data () {
return {
    result:[],

}
},
mounted () {
    
//renderChart function renders the chart with the datacollection and options object.
this.renderChart(this.datacollection, this.options);

},
created(){

},
methods:{

}
}
</script>