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
            weeks = Number(str.substring(0, weekIndex))
        }

        if (dayIndex !== -1) {
            if (weekIndex !== -1) {
                days = Number(str.substring(weekIndex + 1, dayIndex))
            } else {
                days = Number(str.substring(0, dayIndex))
            }
        }

        if (hourIndex !== -1) {
            if (dayIndex !== -1) {
                hours = Number(str.substring(dayIndex + 1, hourIndex))
            } else if (weekIndex !== -1) {
                hours = Number(str.substring(weekIndex + 1, hourIndex))
            } else {
                hours = Number(str.substring(0, hourIndex))
            }
        }

        if (minuteIndex !== -1) {
            if (hourIndex !== -1) {
                minutes = Number(str.substring(hourIndex + 1, minuteIndex))
            } else {
                minutes = Number(str.substring(0, minuteIndex))
            }
        }
        if (secondIndex !== -1) {
            if (minuteIndex !== -1) {
                seconds = Number(str.substring(minuteIndex + 1, secondIndex))
            } else if (hourIndex !== -1) {
                seconds = Number(str.substring(hourIndex + 1, secondIndex))
            } else {
                seconds = Number(str.substring(0, secondIndex))
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
        let final = {}

        if (weekIndex !== -1) {
            weeks = Number(str.substring(0, weekIndex))
        }

        if (dayIndex !== -1) {
            if (weekIndex !== -1) {
                days = Number(str.substring(weekIndex + 1, dayIndex))
            } else {
                days = Number(str.substring(0, dayIndex))
            }
        }

        if (hourIndex !== -1) {
            if (dayIndex !== -1) {
                hours = Number(str.substring(dayIndex + 1, hourIndex))
            } else {
                hours = Number(str.substring(0, hourIndex))
            }
        }

        if (minuteIndex !== -1) {
            if (hourIndex !== -1) {
                minutes = Number(str.substring(hourIndex + 1, minuteIndex))
            } else {
                minutes = Number(str.substring(0, minuteIndex))
            }
        }
        if (secondIndex !== -1) {
            if (minuteIndex !== -1) {
                seconds = Number(str.substring(minuteIndex + 1, secondIndex))
            } else if (hourIndex !== -1) {
                seconds = Number(str.substring(hourIndex + 1, secondIndex))
            } else {
                seconds = Number(str.substring(0, secondIndex))
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
        if (days == 0) {
            final = {
                day: 0,
                time: `${h}:${m}:${s}`
            }
        } else {
            final = {
                day: weeks * 7 + days,
                time: `${h}:${m}:${s}`
            }
        }
        return final
    } else {
        return {
            day: 0,
            time: '00:00:00'
        }
    }
}