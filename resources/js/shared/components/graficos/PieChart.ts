import { defineComponent, h, PropType } from "vue"
import { Pie } from "vue-chartjs"
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement,
    CategoryScale,
    Plugin,
    ChartData,
    DefaultDataPoint,
} from "chart.js"

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

export default defineComponent({
    name: "PieChart",
    components: {
        Pie,
    },
    props: {
        chartData: {
            type: Object as PropType<
                ChartData<"bar", DefaultDataPoint<"bar">, unknown>
            >,
            required: true,
        },
        chartId: {
            type: String,
            default: "pie-chart",
        },
        width: {
            type: Number,
            default: 400,
        },
        height: {
            type: Number,
            default: 400,
        },
        cssClasses: {
            default: "",
            type: String,
        },
        styles: {
            type: Object as PropType<Partial<CSSStyleDeclaration>>,
            default: () => {},
        },
        plugins: {
            type: Array as PropType<Plugin<"pie">[]>,
            default: () => [],
        },
    },
    setup(props) {
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
        }

        return () =>
            h(Pie, {
                chartData: props.chartData,
                chartOptions,
                chartId: props.chartId,
                width: props.width,
                height: props.height,
                cssClasses: props.cssClasses,
                styles: props.styles,
                plugins: props.plugins,
            })
    },
})
