function dtm(str) {
    if (str != null) {
        const weekIndex = str.indexOf("w")
        const dayIndex = str.indexOf("d")
        const hourIndex = str.indexOf("h")
        const minuteIndex = str.indexOf("m")
        const secondIndex = str.indexOf("s")
        let weeks = 0
        let days = 0
        let hours = 0
        let minutes = 0
        let seconds = 0
        let final = ''

        if (weekIndex !== -1) {
            let weekString = str.substring(0, weekIndex);
            if (!isNaN(parseInt(weekString))) {
                weeks = parseInt(weekString);
            }
        }

        if (dayIndex !== -1) {
            let dayString = '';
            if (weekIndex !== -1) {
                dayString = str.substring(weekIndex + 1, dayIndex);
            } else {
                dayString = str.substring(0, dayIndex);
            }
            if (!isNaN(parseInt(dayString))) {
                days = parseInt(dayString);
            }
        }

        if (hourIndex !== -1) {
            let hourString = '';
            if (dayIndex !== -1) {
                hourString = str.substring(dayIndex + 1, hourIndex);
            } else if (weekIndex !== -1) {
                hourString = str.substring(weekIndex + 1, hourIndex);
            } else {
                hourString = str.substring(0, hourIndex);
            }
            if (!isNaN(parseInt(hourString))) {
                hours = parseInt(hourString);
            }
        }

        if (minuteIndex !== -1) {
            let minuteString = '';
            if (hourIndex !== -1) {
                minuteString = str.substring(hourIndex + 1, minuteIndex);
            } else {
                minuteString = str.substring(0, minuteIndex);
            }
            if (!isNaN(parseInt(minuteString))) {
                minutes = parseInt(minuteString);
            }
        }

        if (secondIndex !== -1) {
            let secondString = '';
            if (minuteIndex !== -1) {
                secondString = str.substring(minuteIndex + 1, secondIndex);
            } else if (hourIndex !== -1) {
                secondString = str.substring(hourIndex + 1, secondIndex);
            } else {
                secondString = str.substring(0, secondIndex);
            }
            if (!isNaN(parseInt(secondString))) {
                seconds = parseInt(secondString);
            }
        }

        let h = hours
        let m = minutes
        let s = seconds
        if (hours < 10) {
            h = '0' + hours
        }
        if (minutes < 10) {
            m = '0' + minutes
        }
        if (seconds < 10) {
            s = '0' + seconds
        }
        if (days == 0 && weeks < 1) {
            final = `${h}:${m}:${s}`
        } else {
            final = `${(weeks * 7 + days)}d ${h}:${m}:${s}`
        }
        return final
    } else {
        return '00:00:00'
    }
}

function parsedtm(str) {
    if (str != null) {
        const weekIndex = str.indexOf("w");
        const dayIndex = str.indexOf("d");
        const hourIndex = str.indexOf("h");
        const minuteIndex = str.indexOf("m");
        const secondIndex = str.indexOf("s");
        
        let weeks = weekIndex !== -1 ? Number(str.substring(0, weekIndex)) : 0;
        let days = dayIndex !== -1 ? Number(str.substring(weekIndex + 1, dayIndex)) : 0;
        let hours = hourIndex !== -1 ? Number(str.substring(dayIndex + 1, hourIndex)) : 0;
        let minutes = minuteIndex !== -1 ? Number(str.substring(hourIndex + 1, minuteIndex)) : 0;
        let seconds = secondIndex !== -1 ? Number(str.substring(minuteIndex + 1, secondIndex)) : 0;

        let h = hours < 10 ? '0' + hours : hours;
        let m = minutes < 10 ? '0' + minutes : minutes;
        let s = seconds < 10 ? '0' + seconds : seconds;

        return days == 0 ? { day: 0, time: `${h}:${m}:${s}` } : { day: weeks * 7 + days, time: `${h}:${m}:${s}` };
    } else {
        return { day: 0, time: '00:00:00' };
    }
}


// function parsedtm(str) {
//     if (str != null) {
//         const weekIndex = str.indexOf("w")
//         const dayIndex = str.indexOf("d")
//         const hourIndex = str.indexOf("h")
//         const minuteIndex = str.indexOf("m")
//         const secondIndex = str.indexOf("s")
//         let weeks = 0
//         let days = 0
//         let hours = 0
//         let minutes = 0
//         let seconds = 0
//         let final = {}

//         if (weekIndex !== -1) {
//             weeks = Number(str.substring(0, weekIndex))
//         }

//         if (dayIndex !== -1) {
//             if (weekIndex !== -1) {
//                 days = Number(str.substring(weekIndex + 1, dayIndex))
//             } else {
//                 days = Number(str.substring(0, dayIndex))
//             }
//         }

//         if (hourIndex !== -1) {
//             if (dayIndex !== -1) {
//                 hours = Number(str.substring(dayIndex + 1, hourIndex))
//             } else {
//                 hours = Number(str.substring(0, hourIndex))
//             }
//         }

//         if (minuteIndex !== -1) {
//             if (hourIndex !== -1) {
//                 minutes = Number(str.substring(hourIndex + 1, minuteIndex))
//             } else {
//                 minutes = Number(str.substring(0, minuteIndex))
//             }
//         }
//         if (secondIndex !== -1) {
//             if (minuteIndex !== -1) {
//                 seconds = Number(str.substring(minuteIndex + 1, secondIndex))
//             } else if (hourIndex !== -1) {
//                 seconds = Number(str.substring(hourIndex + 1, secondIndex))
//             } else {
//                 seconds = Number(str.substring(0, secondIndex))
//             }
//         }

//         let h = hours
//         let m = minutes
//         let s = seconds
//         if (hours < 10) {
//             h = '0' + hours
//         }
//         if (minutes < 10) {
//             m = '0' + minutes
//         }
//         if (seconds < 10) {
//             s = '0' + seconds
//         }
//         if (days == 0) {
//             final = {
//                 day: 0,
//                 time: `${h}:${m}:${s}`
//             }
//         } else {
//             final = {
//                 day: weeks * 7 + days,
//                 time: `${h}:${m}:${s}`
//             }
//         }
//         return final
//     } else {
//         return {
//             day: 0,
//             time: '00:00:00'
//         }
//     }
// }