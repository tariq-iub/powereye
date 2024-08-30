const fetchData = async (url, prefix = 'api') => {
    const uri = `/${prefix}/${url}`;
    try {
        const response = await fetch(uri);
        if (!response.ok) {
            console.error(`HTTP error! Status: ${response.status}`);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}

const formatTimestamp = (date, timeframe) => {
    switch (timeframe) {
        case '1d':
            // Show time of day (e.g., 14:30:00)
            return date.toLocaleTimeString('en-GB');

        case '1w':
            // Show day of the week (e.g., Monday)
            return date.toLocaleDateString('en-GB', { weekday: 'long' });

        case '1m':
            // Show day of the month and month (e.g., 01 Aug)
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' });

        case '1y':
            // Show the full month name (e.g., August)
            return date.toLocaleDateString('en-GB', { month: 'long' });

        case 'all':
            // Show the full date with year (e.g., 01 August 2024)
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });

        default:
            // Default to full date and time (e.g., 01/08/2024, 14:30:00)
            return date.toLocaleString('en-GB');
    }
};

