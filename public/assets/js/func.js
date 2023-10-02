function formatBytes(size) {
    var unit = [
        'Byte',
        'KiB',
        'MiB',
        'GiB',
        'TiB',
        'PiB',
        'EiB',
        'ZiB',
        'YiB'
    ];
    for (i = 0; size >= 1024 && i <= unit.length; i++) {
        size = size / 1024;
    }
    return parseFloat(size).toFixed(2) + ' ' + unit[i];
}

function cekBytes(size) {
    var unit = [
        'B',
        'K',
        'M',
        'G',
        'T',
        'P',
        'E',
        'Z',
        'Y'
    ];
    for (i = 0; size >= 1000 && i <= unit.length; i++) {
        size = size / 1000;
    }
    return {
        unit: unit[i],
        value: size
    }
}

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
        // if (weeks == 0 && days == 0) {
        //     final = `${h}:${m}:${s}`
        // } else if (weeks == 0 && days > 0) {
        //     final = `${days}d ${h}:${m}:${s}`
        // } else {
        //     final = `${weeks}w ${days}d ${h}:${m}:${s}`
        // }
        // console.log(str)
        // console.log(Number(str.substring(weekIndex + 1, hourIndex)))
        // console.log(`days : ${days}, hour = ${hourIndex}`)
        if (days == 0 && weeks < 1) {
            final = `${h}:${m}:${s}`
        } else {
            final = `${(weeks * 7 + days)}d ${h}:${m}:${s}`
        }
        // console.log('data : ' + str)
        // console.log('week : ' + weeks)
        // console.log('day : ' + days)
        // console.log('hour : ' + hours)
        // console.log('min : ' + minutes)
        // console.log('sec : ' + seconds)
        // console.log('fin : ' + final)
        // console.log((weeks * 7) + (days * 86400) + (hours * 3600 + minutes * 60 + seconds));
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