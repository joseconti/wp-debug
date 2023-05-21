/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

function getBaseUrl() {
    return window.location.protocol + "//" + window.location.host;
}

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function Save() {
    const blockProps = useBlockProps.save();
    const imageUrl = getBaseUrl() + '/wp-content/plugins/wp-debug/assets/img/Visa-MasterCard.png';

    return (
        <div { ...blockProps }>
            <img src={ imageUrl } alt="Visa MasterCard" />
        </div>
    );
}
