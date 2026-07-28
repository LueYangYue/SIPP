import { useEffect, useRef, useCallback } from "react";

export function ReminderItem({ tab, isActive, isCompact}) {
    const onLeave = useCallback(() => setHovered(false), []);
}
//type ResizeCallback = (entry: ResizeObserverEntry) => void;
/*useNotif(() => {
const pinnedIconSize = isCompact ? 10 : 14;
const pinnedButtonSizeClass = isCompact ? "h-5 w-5" : "h-6 w-6";
return { iconSize: pinnedIconSize, buttonSizeClass: pinnedButtonSizeClass };
const iconSize = isCompact ? 10 : 14;
const buttonSizeClass = isCompact ? "w-6 h-6" : "w-7 h-7";
return { iconSize, buttonSizeClass };   
})*/