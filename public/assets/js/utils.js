const fetchData = async (url, prefix = "api") => {
    const uri = `/${prefix}/${url}`;
    try {
        const response = await fetch(uri);
        if (!response.ok) {
            console.error(`HTTP error! Status: ${response.status}`);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching data:", error);
        return null;
    }
};

const formatTimestamp = (date, timeframe) => {
    switch (timeframe) {
        case "1d":
            return date.toLocaleTimeString("en-GB");

        case "1w":
            return date.toLocaleDateString("en-GB", { weekday: "long" });

        case "1m":
            return date.toLocaleDateString("en-GB", {
                day: "2-digit",
                month: "short",
            });

        case "1y":
            return date.toLocaleDateString("en-GB", { month: "long" });

        case "all":
            return date.toLocaleDateString("en-GB", {
                day: "2-digit",
                month: "long",
                year: "numeric",
            });

        default:
            return date.toLocaleString("en-GB");
    }
};

let lastUsedLightnessSet = new Set();

function generateChartColors(
    length,
    options = { sameShade: false, baseHue: 200 }
) {
    const colors = [];
    const lightnessStep = Math.floor(40 / (length - 1));

    if (options.sameShade) {
        const { baseHue } = options;

        for (let i = 0; i < length; i++) {
            const lightness = 50 + i * lightnessStep;
            const color = `hsl(${baseHue}, 100%, ${lightness}%)`;
            colors.push(color);
        }

        lastUsedLightnessSet = new Set(
            colors.map((color) => parseInt(color.match(/(\d+)%\)$/)[1], 10))
        );
    } else {
        const usedHues = new Set();

        while (colors.length < length) {
            const hue = Math.floor(Math.random() * 360);
            const saturation = Math.floor(Math.random() * 21) + 70;
            const lightness = Math.floor(Math.random() * 21) + 40;

            if (!usedHues.has(hue)) {
                usedHues.add(hue);
                const color = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
                colors.push(color);
            }
        }
    }

    return colors;
}
